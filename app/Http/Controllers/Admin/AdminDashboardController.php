<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Page;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\WebsiteParameter;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Services\SiteCacheService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        menuSubmenu('dashboard','adminDashboard');
        return view('admin.dashboard', [
            'totalPosts'      => Post::count(),
            'totalPages'      => Page::count(),
            'totalCategories' => Category::count(),
            'totalMessages'   => CustomerDetail::count(),

            'latestPosts'     => Post::latest()->limit(5)->get(),
            'latestMessages'  => CustomerDetail::latest()->limit(5)->get(),
        ]);
    }



    public function websiteParameter()
    {
        menuSubmenu('dashboard','websiteParameter');
        $post= WebsiteParameter::latest()->first();
        return view('admin.websiteParameter',compact('post'));
    }
    public function websiteParameterUpdate(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [ 

            'meta_keyword' => 'max:255',
            'featured_video'   => 'nullable|mimes:mp4,webm,mov|max:61440',
            'primary_color'    => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color'  => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'hero_type' => 'required|in:image,video',
            'linkedin_url' => 'nullable|string|max:500',
            'home_services_front_title' => 'nullable|string|max:255',
            'home_services_front_text' => 'nullable|string',
            'home_services_back_title' => 'nullable|string|max:255',
            'home_services_back_text' => 'nullable|string',
            'home_services_back_button_text' => 'nullable|string|max:120',
            'home_services_back_button_link' => 'nullable|string|max:500',
            'home_services_right_1_title' => 'nullable|string|max:255',
            'home_services_right_1_text' => 'nullable|string',
            'home_services_right_1_link_text' => 'nullable|string|max:120',
            'home_services_right_1_link' => 'nullable|string|max:500',
            'home_services_right_2_title' => 'nullable|string|max:255',
            'home_services_right_2_text' => 'nullable|string',
            'home_services_right_2_link_text' => 'nullable|string|max:120',
            'home_services_right_2_link' => 'nullable|string|max:500',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Worng!');
        }

        if ($request->hero_type === 'image' && $request->hasFile('featured_image')) {

            $img = Image::make($request->file('featured_image'));
            if ($img->width() != 1200 || $img->height() != 340) {
                return back()->withErrors([
                    'featured_image' => 'Image must be exactly 1200 × 340 pixels'
                ]);
            }
        }

        $request = request();
        $post = WebsiteParameter::firstOrCreate([]);
        $post->title = $request->title;
        $post->short_title = $request->short_title;
        $post->h1 = $request->h1;
        $post->welcome_page_msg = $request->welcome_page_msg;
        $post->user_page_msg = $request->user_page_msg;
        $post->google_analytics_code = $request->google_analytics_code;
        $post->facebook_pixel_code = $request->facebook_pixel_code;
        $post->meta_author = $request->meta_author;
        $post->meta_keyword = $request->meta_keyword;
        $post->meta_description = $request->meta_description;
        $post->slogan = $request->slogan;
        $post->footer_address = $request->footer_address;
        $post->footer_copyright = $request->footer_copyright;
        $post->addthis_url = $request->addthis_url;
        $post->fb_page_link = $request->fb_url;
        $post->fb_page_code = $request->fb_page_code;
        $post->youtube_url = $request->youtube_url;
        $post->contact_mobile = $request->contact_mobile;
        $post->contact_email = $request->contact_email;
        $post->twitter_url = $request->twitter_url;
        $post->linkedin_url = $request->linkedin_url;
        $post->primary_color   = $request->primary_color;
        $post->secondary_color = $request->secondary_color;
        $post->hero_type = $request->hero_type;
        $post->front_team_show = $request->front_team_show ? 1 : 0;
        $post->google_map_code_contact = $request->google_map_code_contact;
        $post->google_map_code = $request->google_map_code;

        $post->home_services_front_title = $request->home_services_front_title;
        $post->home_services_front_text = $request->home_services_front_text;
        $post->home_services_back_title = $request->home_services_back_title;
        $post->home_services_back_text = $request->home_services_back_text;
        $post->home_services_back_button_text = $request->home_services_back_button_text;
        $post->home_services_back_button_link = $request->home_services_back_button_link;

        $post->home_services_right_1_title = $request->home_services_right_1_title;
        $post->home_services_right_1_text = $request->home_services_right_1_text;
        $post->home_services_right_1_link_text = $request->home_services_right_1_link_text;
        $post->home_services_right_1_link = $request->home_services_right_1_link;

        $post->home_services_right_2_title = $request->home_services_right_2_title;
        $post->home_services_right_2_text = $request->home_services_right_2_text;
        $post->home_services_right_2_link_text = $request->home_services_right_2_link_text;
        $post->home_services_right_2_link = $request->home_services_right_2_link;

        
        if ($request->news_editions) {
            $post->news_editions = implode(',',$request->news_editions);
        }else
        {
            $post->news_editions = 'en';
        }


        if($request->favicon)
        {
            $file = $request->favicon;
            Storage::disk('public')->delete('favicon/'.$post->favicon);

            $originalName = $file->getClientOriginalName();
            Storage::disk('public')->put('favicon/'.$originalName, File::get($file));
            $post->favicon = $originalName;
        }

        if($request->logo)
        {
            $file = $request->logo;
            Storage::disk('public')->delete('logo/'.$post->logo);

            $originalName = $file->getClientOriginalName();
            Storage::disk('public')->put('logo/'.$originalName, File::get($file));
            $post->logo = $originalName;
        }
        if($request->logo_alt)
        {
            $file = $request->logo_alt;
            Storage::disk('public')->delete('logo/'.$post->logo_alt);

            $originalName = $file->getClientOriginalName();
            Storage::disk('public')->put('logo/'.$originalName, File::get($file));
            $post->logo_alt = $originalName;
        }

        if ($request->featured_image) {
            $file = $request->featured_image;

            Storage::disk('public')->delete('featured/'.$post->featured_image);

            $name = time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('featured/'.$name, File::get($file));

            $post->featured_image = $name;
        }


        if ($request->hasFile('featured_video')) {

            if ($post->featured_video) {
                    Storage::disk('public')->delete('featured-video/'.$post->featured_video);
                }

                $video = $request->file('featured_video');
                $name  = time().'_'.$video->getClientOriginalName();

                Storage::disk('public')
                    ->put('featured-video/'.$name, file_get_contents($video));

                $post->featured_video = $name;
            }



        $post->save();

        SiteCacheService::flushSiteCaches();

        return back()->with('success', 'Website Parameter Successfully Updated.');
    }
    public function selectUserForAssignRole(Request $request)
    {
        $users = User::where('email', 'like', '%' . $request->q . '%')
            ->orWhere('name', 'like', '%'.$request->q.'%')
            ->select(['id', 'name', 'email'])->take(30)->get();
        if ($users->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $users;
            }
        } else {
            if ($request->ajax()) {
                return $users;
            }
        }
    }
}
