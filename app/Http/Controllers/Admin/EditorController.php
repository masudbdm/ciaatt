<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostSubcategory;
use App\Models\Tag;
use App\Models\WebsiteParameter;
use Illuminate\Http\Request;
// use Validator;
// use Auth;
use DB;
use App\Services\SiteCacheService;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// use Spatie\Translatable;
class EditorController extends Controller
{
    public $websiteParamiter;
    public function __construct()
    {
        $this->websiteParameter = WebsiteParameter::first();
    }
    public function addNewPost(Request $request)
    {
        // dd("ok");
        menuSubmenu('post', 'addNewPost');
        $cats = Category::all();
        $post = Post::where('publish_status', 'temp')->first();
        $mediaAll = Media::latest()->paginate(200);
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }

        SiteCacheService::flushSiteCaches();

        return view('admin.post.addNewPost', compact('cats', 'post', 'mediaAll'));
    }

    public function selectTagsOrAddNew(Request $request)
    {
        $tags = Tag::where('title', 'like', '%' . $request->q . '%')
            ->select(['title'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }
    public function allPost()
    {
        menuSubmenu('post', 'allPost');
        $posts = Post::latest()->where('publish_status', '!=', 'temp')->get();
        return view('admin.post.allPosts', compact('posts'));
    }

    public function storePost(Request $request)
    {
        // dd($request->feature_image);
        $validation = Validator::make(
            $request->all(),
            [
                // "title" => "title",
                // "description" => "required",
                // "publish" => "on"
                // 'excerpt' => 'max:254|required',
                // 'feature_image' => 'image|dimensions:min_with=310,min_height=200,ratio=3/2'
                'feature_image' => 'image|dimensions:min_with=310,min_height=200'
                // 'feature_image' => 'required'
            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Wrong!');
        }

        $web_editons = explode(',', WebsiteParameter::first()->news_editions);

        foreach ($web_editons as $key => $lan) {
            $tagFieldName = $lan . "_tags";
            if ($request[$tagFieldName]) {
                foreach ($request[$tagFieldName] as $tag) {
                    $t = Tag::where('title', $tag)->first();
                    if (!$t) {
                        $t = new Tag;
                        $t->title = $tag;
                        $t->addedby_id = Auth::id();
                        $t->save();
                    }
                }
            }
        }

        $description = [];
        $tags = [];
        $titles = [];
        $excerpts = [];
        foreach ($web_editons as $key => $lan) {
            $descriptionField = $lan . "_description";
            $tagFieldName = $lan . "_tags";
            $titleFieldName = $lan . "_title";
            $excerptFieldName = $lan . "_excerpt";

            $des = $request[$descriptionField];
            $tag = $request[$tagFieldName];
            $title = $request[$titleFieldName];
            $excerpt = $request[$excerptFieldName];

            $description[$lan] = $des;
            $tags[$lan] = $tag;
            $titles[$lan] = $title;
            $excerpts[$lan] = $excerpt;
        }

        
        


        $post = Post::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }

        $post->title = $titles ?? null;
        $post->description =  $description ?? null;
        $post->excerpt = $excerpts ?? null;
        $post->tags = $tags;
        $post->publish_status = $request->publish ? 'published' : 'draft';
        $post->front_slider = $request->front_slider ? true : false;
        $post->headline = $request->headline ? true : false;
        $post->highlight = $request->highlight ? true : false;
        $post->writer_id = $request->author;
        $post->addedby_id = Auth::id();
        $post->published_at = date('Y-m-d H:i:s', strtotime("$request->publish_date $request->publish_time"));
        if ($request->hasFile('feature_image')) {

            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = rand(1111, 9999) . time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();

            Storage::disk('public')->put('media/image/' . $fimageNewName, File::get($ffile));

            if ($post->feature_img_name) {

                Storage::disk('public')->delete('media/image/' . $post->feature_img_name);
            }

            $post->feature_img_name = $fimageNewName;
            $post->feature_img_original_name = $originalName;
            $post->feature_img_ext = $fimgExt;
        }
        $post->save();
        $post->categories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        $post->subcategories()->detach();
        if ($request->subCategories) {
            foreach ($request->subCategories as $cat) {

                $c = PostSubcategory::where('subcategory_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostSubcategory;
                    $c->subcategory_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }

        SiteCacheService::flushSiteCaches();

        return redirect()->back()->with('success', 'Post Added Successfully');
    }

    public function viewPost(Request $request)
    {

        // return PostCategory::all();
        $post = Post::findBySlug($request->slug);
        return view('admin.post.viewPost', compact('post'));
    }
    public function editPost(Post $post, Request $request)
    {
        menuSubmenu('post', 'editPost');
        $cats = Category::all();
        $oldTags = $post->tags ?? null;
        $mediaAll = Media::latest()->paginate(200);
        $test = Media::latest()->first();
        return view('admin.post.editPost', [
            'post' => $post,
            'cats' => $cats,
            'oldTags' => $oldTags,
            'mediaAll' => $mediaAll,
            'test'=>$test

        ]);
    }
    public function updtePost(Post $post, Request $request)
    {

        $web_editons = explode(',', WebsiteParameter::first()->news_editions);

        foreach ($web_editons as $key => $lan) {
            $tagFieldName = $lan . "_tags";
            if ($request[$tagFieldName]) {
                foreach ($request[$tagFieldName] as $tag) {
                    $t = Tag::where('title', $tag)->first();
                    if (!$t) {
                        $t = new Tag;
                        $t->title = $tag;
                        $t->addedby_id = Auth::id();
                        $t->save();
                    }
                }
            }
        }

        $description = [];
        $tags = [];
        $titles = [];
        $excerpts = [];
        foreach ($web_editons as $key => $lan) {
            $descriptionField = $lan . "_description";
            $tagFieldName = $lan . "_tags";
            $titleFieldName = $lan . "_title";
            $excerptFieldName = $lan . "_excerpt";

            $des = $request[$descriptionField];
            $tag = $request[$tagFieldName];
            $title = $request[$titleFieldName];
            $excerpt = $request[$excerptFieldName];

            $description[$lan] = $des;
            $tags[$lan] = $tag;
            $titles[$lan] = $title;
            $excerpts[$lan] = $excerpt;
        }
        // $post = Post::where('publish_status', 'temp')->first();
        if (!$post) {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }
        // return $titles;
        $post->title = $titles ?? null;

        $post->description =  $description ?? null;
        $post->excerpt = $excerpts ?? null;
        $post->tags = $tags;
        $post->publish_status = $request->publish ? 'published' : 'draft';
        $post->front_slider = $request->front_slider ? true : false;
        $post->headline = $request->headline ? true : false;
        $post->highlight = $request->highlight ? true : false;
        $post->writer_id = $request->author;
        $post->addedby_id = Auth::id();
        $post->published_at = date('Y-m-d H:i:s', strtotime("$request->publish_date $request->publish_time"));
        
        if ($request->hasFile('feature_image')) {
            $prviewFilePath = 'media/image/' . $post->feature_img_name;
            if (Storage::disk('public')->exists($prviewFilePath)) {
                Storage::disk('public')->delete($prviewFilePath);
            }
            $ffile = $request->feature_image;
            $fimgExt = strtolower($ffile->getClientOriginalExtension());
            $fimageNewName = image_slug($post->title) . "_" . rand(11, 99) . time() . '.' . $fimgExt;
            $originalName = $ffile->getClientOriginalName();

            Storage::disk('public')->put('media/image/' . $fimageNewName, File::get($ffile));

            if ($post->feature_img_name) {

                Storage::disk('public')->delete('media/image/' . $post->feature_img_name);
            }

            $post->feature_img_name = $fimageNewName;
            $post->feature_img_original_name = $originalName;
            $post->feature_img_ext = $fimgExt;
        }
        $post->save();
        $post->categories()->detach();
        if ($request->categories) {
            foreach ($request->categories as $cat) {
                $c = PostCategory::where('category_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostCategory;
                    $c->category_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }
        $post->subcategories()->detach();
        if ($request->subCategories) {
            foreach ($request->subCategories as $cat) {

                $c = PostSubcategory::where('subcategory_id', $cat)->where('post_id', $post->id)->first();
                if (!$c) {
                    $c = new PostSubcategory;
                    $c->subcategory_id = $cat;
                    $c->post_id = $post->id;
                    $c->addedby_id = Auth::id();
                    $c->save();
                }
            }
        }

        SiteCacheService::flushSiteCaches();
        return redirect()->back()->with('success', 'Post Added Successfully');
    }

    public function deletePost(Post $post)
    {
        DB::transaction(function () use ($post) {
            // Delete feature image file (if exists)
            if (!empty($post->feature_img_name)) {
                $path = 'media/image/' . $post->feature_img_name;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            // Remove pivot/related rows
            PostCategory::where('post_id', $post->id)->delete();
            PostSubcategory::where('post_id', $post->id)->delete();

            // Finally delete post
            $post->delete();
        });

        SiteCacheService::flushSiteCaches();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
