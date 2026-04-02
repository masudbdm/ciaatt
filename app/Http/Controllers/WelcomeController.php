<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\Menu;
use App\Models\MenuPage;
use App\Models\Page;
use App\Models\Post;
use App\Models\Team;
use App\Models\PostCategory;
use App\Models\WebsiteParameter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{

    public function welcome()
    {
        $categoriesPost = Cache::remember('home_categories_post', now()->addDays(7), function () {
            return Category::whereHas('posts')
                ->orderBy('drag_id')
                ->get();
        });

        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $postCategories = Cache::remember('home_post_categories', now()->addDays(7), function () {
            return PostCategory::all();
        });

        $posts = Cache::remember('home_posts_random_24', now()->addDays(7), function () {
            return Post::where('publish_status', '<>', 'temp')
                ->inRandomOrder()
                ->limit(24)
                ->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $featured_teams = Cache::remember('featured_teams', now()->addDays(7), function () {
                return Team::where('status', 1)
                    ->where('featured', 1)
                    ->orderByRaw('drag_id IS NULL, drag_id ASC')
                    ->limit(4)
                    ->get();
            });


        return view('home.welcome', compact(
            'categories',
            'posts',
            'postCategories',
            'categoriesPost',
            'pages',
            'featured_teams'
        ));
    }


    public function categories()
    {
        return view('home.categories');
    }

    public function categoryDetails(Category $category)
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        $findPosts = PostCategory::where('category_id',$category->id)->pluck('post_id');

        $posts = Post::find($findPosts);

        $postsForRightSidebar = Post::where('publish_status','published')->latest()->take(5)->get();

        // $allPosts = Post::latest()->take(3)->get();

        // dd($posts);
        return view('home.categoryDetails',compact('categories','category','pages','postsForRightSidebar','posts'));
    }

    public function menuDetails(Request $request)
    {
        // dd("function menuDetails");
        // dd($request->menuId);
        $menu = Menu::find($request->menuId);

        // $menuPageID = MenuPage::where('menu_id',$request->menuId)->value('page_id');
        $menuPageID = MenuPage::where('menu_id',$request->menuId)->value('page_id');

        // dd($menuPageID);

        if($menuPageID)
        {
            $pageItems = Page::find($menuPageID)->items;

            // dd($pageItems);

            if($pageItems->count() > 0)
            {
                return view('home.menuDetails',compact('menu','pageItems'));
            }

        }

        return view('home.menuDetails',compact('menu'));
    }

    public function pageDetails(Request $request)
    {
        // dd("Function pageDetails");
        // dd($request->page);
        $page = Page::find($request->page);

        // dd($page);
        
        $pageItems = Page::find($request->page)->items;

        // dd($pageItems->count());
        if ($pageItems->count() == 0) 
        {
            return view('home.pageDetails',compact('page'));
        }
        else
        {
            return view('home.pageDetails',compact('page','pageItems'));
        }

    }

    public function details()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });

        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });

        
        return view('home.details',compact('categories','pages'));
    }

    public function companyProfile()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.companyProfile',compact('categories','pages'));
    }

    public function aboutUs()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.aboutUs',compact('categories','pages'));
    }

    public function contactUs()
    {
        $categories = Cache::remember('home_categories', now()->addDays(7), function () {
            return Category::orderBy('drag_id')->get();
        });
        $pages = Cache::remember('home_pages', now()->addDays(7), function () {
            return Page::orderBy('drag_id')->get();
        });
        return view('home.contactUs', compact('categories','pages') );
    }

    public function postDetails(Post $post)
    {
        // dd("function postDetails");
        // $categories = Category::orderBy('drag_id')->get();

        $posts = Post::where('publish_status','published')->where('id','<>',$post->id)->latest()->take(5)->get();

        // dd($allPosts);

        return view('home.postDetails',compact('posts','post'));
    }



    public function information(Request $request)
{
    // Honeypot spam check
    if ($request->filled('website')) {
        abort(403, 'Spam detected');
    }

    /**
     * 1️⃣ Sanitize input
     */
    $input = [
        'customer_name'    => trim(strip_tags($request->customer_name)),
        'customer_email'   => filter_var($request->customer_email, FILTER_SANITIZE_EMAIL),
        'customer_message' => trim(strip_tags($request->customer_message)),
    ];

    /**
     * 2️⃣ Validate customer data
     */
    $validator = Validator::make($input, [
        'customer_name'    => 'required|string|max:100',
        'customer_email'   => 'required|email:rfc,dns|max:150',
        'customer_message' => 'required|string|max:2000',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    /**
     * 3️⃣ Save to DB (safe data)
     */
    $infoStore = new CustomerDetail;
    $infoStore->customer_name    = $input['customer_name'];
    $infoStore->customer_email   = $input['customer_email'];
    $infoStore->customer_message = $input['customer_message'];
    $infoStore->save();

    /**
     * 4️⃣ Validate admin contact email
     */
    $websiteParameter = WebsiteParameter::first();

    if (
    !$websiteParameter ||
    empty($websiteParameter->contact_email) ||
    !filter_var($websiteParameter->contact_email, FILTER_VALIDATE_EMAIL)
) {
    Log::warning('Invalid contact_email in WebsiteParameter');
    return back()->with('success', 'Your message successfully submitted.');
}


    /**
     * 5️⃣ Send mail (only if both emails valid)
     */
    try {
        Mail::to($websiteParameter->contact_email)
            ->send(new ContactMessageMail([
                'name'    => $input['customer_name'],
                'email'   => $input['customer_email'],
                'message' => $input['customer_message'],
            ]));
    } catch (\Throwable $e) {
        Log::error('Contact mail failed: ' . $e->getMessage());
        // Silent fail: user not affected
    }

    return redirect()->back()->with('success', 'Your message successfully submitted.');
}


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
    //Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //Google Callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        //Return after login
        return redirect()->route('home');
    }


    //Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    //Facebook Callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);
        //Return after login
        return redirect()->route('home');
    }

    public function post(Request $request)
    {
        app()->setLocale($request->lan);
        app()->getLocale();
        $post = Post::first();
        return $post->title;
    }
    public function allNews(Request $request)
    {
        if(!(getLang() == $request->lan)){
         setLang($request->lan);
        };
        App::setLocale($request->lan);
        $posts = Post::with('writer', 'categories', 'subcategories')->latest()->get();
        return view('news.allnews', compact('posts'));
    }
    public function newsDetails(Request $request)
    {
        if(!(getLang() == $request->lan)){
            setLang($request->lan);
         };
         App::setLocale($request->lan);
        $news= Post::find($request->news);
        //   dd(app()->getLocale());
        return view('news.newsDetails',compact('news'));
    }


    public function setlan(Request $request)
    {
        setLang($request->lan);
        App::setlocale($request->lan);
        // if (Auth::check()) {
        //     $user= Auth::user();
        //     $user->language= $request->lan;
        //     $user->save();
            
        //     App::setLocale($user->language);
        //     Cookie::queue('lang',$user->language,1000000);
        // }else{
        //     App::setLocale($request->lan);
        //     Cookie::queue('lang',$request->lan,1000000);
        // }
     return true;
    }
   

    public function setLanguage(Request $request)
    {
        $lan = $request->lan;
        $min = 60 * 24 * 30 * 2; //for 2 months;
        Cookie::queue('edition', $lan, $min);
       
        return redirect('/');
    }

    public function teams()
    {
        $teams = Cache::remember('teams', now()->addDays(7), function () {
                return Team::where('status', 1)
                        ->orderByRaw('drag_id IS NULL, drag_id ASC')
                        ->get();
                        });

        return view('home.teams', compact('teams'));
    }

    public function teamShow(string $slug)
    {
        $team = Team::where('username', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('home.teamDetails', compact('team'));
    }
}
