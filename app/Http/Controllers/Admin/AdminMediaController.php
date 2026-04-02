<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoGalleryRequest;
use App\Models\Category;
use App\Models\ImageGallery;
use App\Models\ImageGalleryItem;
use App\Models\Media;
use App\Models\Post;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
// use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Validator;

class AdminMediaController extends Controller
{
    public function mediaAll(Request $request)
    {

        menuSubmenu('mediaAll', 'mediaAll');
        $mediaAll = Media::orderBy('id', 'desc')->paginate(50);
        return view('admin.media.mediaAll', ['mediaAll' => $mediaAll]);
    }
    public function mediaAllAjax(Request $request)
    {
        $mediaAll = Media::latest()->paginate(50);
       $view= view('admin.media.ajax.mediaAllAjax',compact('mediaAll'))->render();
       
       if ($request->ajax()) {
        return Response()->json([
            'html'=>$view,
        ]);
    }
    }
    public function mediaUpload(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'files.*' => 'image'
            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Wrong!');
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $mime = $file->getClientMimeType();
                $size = $file->getSize();
                $fileNewName = Str::random(4) . date('ymds') . '.' . $ext;
                list($width, $height) = getimagesize($file);

                Storage::disk('public')
                    ->put('media/image/' . $fileNewName, File::get($file));

                $file_new_url = 'storage/media/image/' . $fileNewName;

                $media = new Media;
                $media->file_name = $fileNewName;
                $media->file_original_name = $originalName;
                $media->file_mime = $mime;
                $media->file_ext = $ext;
                $media->file_size = $size;

                $media->width = $width;
                $media->height = $height;
                $media->file_url = $file_new_url;
                $media->collection_name = $request->collection_name ? 1 : 0;
                $media->addedby_id = Auth::id();
                if ($mime == 'image/gif' or $mime == 'image/png' or $mime == 'image/jpeg' or $mime == 'image/bmp') {
                    $media->file_type = 'image';
                }
                //image/gif, image/png, image/jpeg, image/bmp, image/webp

                $media->save();
            }

            Cache::flush();
        }

        


        return back();
    }
    public function mediaUploadDropZon(Request $request)
    {

        if ($request->hasFile('file')) {
            $mp = $request->file;
            $originalName = $mp->getClientOriginalName();
            $ext = $mp->getClientOriginalExtension();
            $mime = $mp->getClientMimeType();
            $size = $mp->getSize();
            $fileNewName = Str::random(4) . date('ymds') . '.' . $ext;
            list($width, $height) = getimagesize($mp);

            Storage::disk('public')
                ->put('media/image/' . $fileNewName, File::get($mp));

            $file_new_url = 'storage/media/image/' . $fileNewName;

            $media = new Media;
            $media->file_name = $fileNewName;
            $media->file_original_name = $originalName;
            $media->file_mime = $mime;
            $media->file_ext = $ext;
            $media->file_size = $size;

            $media->width = $width;
            $media->height = $height;
            $media->file_url = $file_new_url;
            $media->collection_name = $request->collection_name ? 1 : 0;
            $media->addedby_id = Auth::id();
            if ($mime == 'image/gif' or $mime == 'image/png' or $mime == 'image/jpeg' or $mime == 'image/bmp') {
                $media->file_type = 'image';
            }
            //image/gif, image/png, image/jpeg, image/bmp, image/webp

            $media->save();

            Cache::flush();
            return "OK";
        }
    }
    public function mediaDelete(Media $media, Request $request)
    {
        $f = 'media/image/' . $media->file_name;
        $e = 'media/category/image/' . $media->file_name;
        $g = 'media/category/banner/' . $media->file_name;
        $h = 'media/post' . $media->file_name;


        if (Storage::disk('public')->exists($f)) {
            Storage::disk('public')->delete($f);
            $media->delete();
        } elseif (Storage::disk('public')->exists($e)) {
            Storage::disk('public')->delete($f);
            $media->delete();
        } elseif (Storage::disk('public')->exists($g)) {
            Storage::disk('public')->delete($g);
            $media->delete();
        } elseif (Storage::disk('public')->exists($h)) {
            Storage::disk('public')->delete($h);
            $media->delete();
        }

        Cache::flush();

        return back()->with('info', 'Media successfully deleted.');
    }
    //Image Gallery

    public function imageGalleriesAll()
    {
        menuSubmenu('gallery', 'imageGalleriesAll');
        $galleries = ImageGallery::where('publish_status', '<>', 'temp')->latest()->paginate(40);
        return view('admin.gallery.imgGalleriesAll', ['galleries' => $galleries]);
    }
    public function addNewImageGallery()
    {
        menuSubmenu('gallery', 'addNewImageGallery');

        $ig = ImageGallery::where('publish_status', 'temp')->first();
        $mediaAll = Media::latest()->paginate(200);
        if (!$ig) {
            $ig = new ImageGallery;
            $ig->addedby_id = Auth::id();
            $ig->save();
            for ($x = 1; $x <= 20; $x++) {
                $igi = new ImageGalleryItem;
                $igi->image_gallery_id = $ig->id;
                $igi->addedby_id = Auth::id();
                $igi->save();
            }
        }
        if (!$ig->items()->count()) {
            for ($x = 1; $x <= 20; $x++) {
                $igi = new ImageGalleryItem;
                $igi->image_gallery_id = $ig->id;
                $igi->addedby_id = Auth::id();
                $igi->save();
            }
        }

        Cache::flush();
        return view('admin.gallery.imgGalleryAddNew', [

            'mediaAll' => $mediaAll,
            'imageGallery' => $ig
        ]);
    }
    public function imgGalleryItemAjaxPost(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'img_url' => 'required|max:255'
            ]
        );
        if ($validation->fails()) {

            if ($request->ajax()) {
                return Response()->json(array(
                    'success' => false,
                    'errors' => $validation->errors()->toArray()
                ));
            }

            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Worng!');
        }

        $igi = ImageGalleryItem::where('id', $request->item)->first();
        if ($igi) {
            $igi->title = $request->title ?: null;
            $igi->description = $request->description ?: null;
            $igi->img_url = $request->img_url ?: null;
            $igi->photo_credit = $request->photo_credit ?: null;
            $igi->editedby_id = $request->user()->id;
            $igi->publish_status = 'published';
            $igi->save();
        }

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json(array('success' => true));
        }

        return back()->with('success', 'Data Successfully Saved');
    }
    public function imgGalleryAddNewPost(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'max:255',
                'description' => 'max:255',
            ]
        );
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Worng!');
        }

        $ig = ImageGallery::where('publish_status', 'temp')->first();

        if ($ig) {
            $ig->title = $request->title ?: null;
            $ig->description = $request->description ?: null;
            $ig->publish_status = $request->publish ? 'published' : 'draft';
            $ig->link_url = $request->link_url ?: null;
            $ig->editedby_id = Auth::id();
            $ig->save();

            $ig->items()->where('publish_status', 'temp')->delete();
        }

        Cache::flush();

        return back()->with('success', 'Your Gallery Successfully Saved.');
    }
    public function imgGalleryEdit(Request $request, ImageGallery $gallery)
    {
        $mediaAll = Media::latest()->paginate(200);

        for ($x = $gallery->items()->count(); $x <= 20; $x++) {
            $igi = new ImageGalleryItem;
            $igi->image_gallery_id = $gallery->id;
            $igi->addedby_id = Auth::id();
            $igi->save();
        }

        return view('admin.gallery.imgGalleryEdit', [
            'imageGallery' => $gallery,
            'mediaAll' => $mediaAll
        ]);
    }
    public function gallery(ImageGallery $gallery, Request $request)
    {

        $galleries = ImageGallery::has('items')->where('publish_status', 'published')
            // ->whereNotIn('id',[$latestGallery->id])
            ->latest()->paginate(36);

        $headlines = Post::where('publish_status', 'published')->where('headline', true)->latest()->paginate(10);
        $catsAll = Category::orderBy('drag_id')->limit(14)->paginate(14);


        $ca = Category::count();
        $skip =  13;
        $take = $skip - $ca;
        // return $take;
        $catsOthers = Category::orderBy('drag_id')->skip($skip)->take($take)->get();
        // return $catsOthers;
        $latest = Post::where('publish_status', 'published')->orderBy('updated_at', 'desc')->first();
        $today = Carbon::now();
        $time = $latest ? $latest->updated_at->diffForHumans() : '';

        return view('welcome.gallery', [
            'catsAll' => $catsAll,
            'catsOthers' => $catsOthers,
            'headlines' => $headlines,
            'time' => $time,
            'today' => $today,
            'latestGallery' => $gallery,
            'galleries' => $galleries,

        ]);
    }

    public function imgGalleryDelete(Request $request, ImageGallery $gallery)
    {
        $gallery->items()->delete();
        $gallery->delete();

        Cache::flush();

        return back()->with('info', 'Gallery Successfully Deleted.');
    }
    public function imgGalleryEditPost(Request $request, ImageGallery $gallery)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'max:255',
                'description' => 'max:255',
            ]
        );
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Worng!');
        }

        $ig = $gallery;

        if ($ig) {
            $ig->title = $request->title ?: null;
            $ig->description = $request->description ?: null;
            $ig->publish_status = $request->publish ? 'published' : 'draft';
            $ig->link_url = $request->link_url ?: null;
            $ig->editedby_id = Auth::id();
            $ig->save();

            $ig->items()->where('publish_status', 'temp')->delete();
        }

        Cache::flush();

        return redirect()->route('admin.imgGalleriesAll')->with('success', 'Your Gallery Successfully Updated.');
    }

    ////Video Gallery START
    public function addVideoGallery()
    {
        menuSubmenu('videoGallery', 'addVideoGallery');
        $vg = VideoGallery::where('publish_status', 'temp')->where('user_id', Auth::id())->first();
        if (!$vg) {
            $vg = new VideoGallery;
            $vg->user_id = Auth::id();
            $vg->addedby_id = Auth::id();
            $vg->publish_status = 'temp';
            $vg->save();
        }

        Cache::flush();
        return view('admin.gallery.video.videoGalleryAddNew', ['videoGallery' => $vg]);
    }

    public function storeVideoGallery(VideoGallery $vg, VideoGalleryRequest $request)
    {
        $vg->title = $request->title;
        $vg->description = $request->description;
        $vg->videoUrl = embededURL($request->videoUrl);
        $vg->publish_status = 'published';
        $vg->save();

        Cache::flush();

        return redirect()->back()->with('success', 'Video Added Successfully');
    }
    public function videoGalleriesAll()
    {
        menuSubmenu('videoGallery', 'videoGalleriesAll');
        $videoGalleries = VideoGallery::where('publish_status', '!=', 'temp')->latest()->paginate(30);
        return view('admin.gallery.video.videoGalleriesAll', compact('videoGalleries'));
    }
    public function editVideoGallery(Request $request)
    {
        $videoGallery = VideoGallery::find($request->gallery);
        return view('admin.gallery.video.videoGalleryEdit', compact('videoGallery'));
    }
    public function updateVideoGallery(VideoGalleryRequest $request)
    {
        $vg = VideoGallery::find($request->gallery);
        $vg->title = $request->title;
        $vg->description = $request->description;
        $vg->videoUrl = embededURL($request->videoUrl);
        $vg->save();

        Cache::flush();

        return redirect()->back()->with('success', 'Gallery Video updated Successfully');
    }
    public function deleteVideoGallery(Request $request)
    {
        $vg = VideoGallery::find($request->gallery);
        $vg->delete();

        Cache::flush();

        return redirect()->back()->with('success', 'Video Galllery item Deleted Successfully');
    }
    ////Video Gallery END
    public function featureImageDelete(Post $post, Request $request)
    {
        $prviewFilePath = 'media/image/' . $post->feature_img_name;
        if (Storage::disk('public')->exists($prviewFilePath)) {
            Storage::disk('public')->delete($prviewFilePath);
            $post->feature_img_name = null;
            $post->feature_img_original_name = null;
            $post->feature_img_mime = null;
            $post->feature_img_ext = null;
            $post->save();

            Cache::flush();
            
            return back()->with('success', 'Feature Image Deleted Successfully');
        }
        return back();
    }
    public function imageDetails(Media $media, Request $request)
    {
        return view('admin.post.ajax.mediaDetails', compact('media'))->render();
    }
}
