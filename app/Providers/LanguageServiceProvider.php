<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('*', function ($view) {
        //     if (Auth::check()) {
                
        //     //    app()->setLocale(Auth::user()->language);
        //     //    Cookie::queue('lan',Auth::user()->language,1000000);
        //     } elseif (Cookie::has('lan')) {
        //         // $dcrypt_cookie = Crypt::decrypt(Cookie::get('lan'), false);
        //         // $ex = explode('|', $dcrypt_cookie);
        //         // $locale = $ex[1];
        //         //    app()->setLocale($locale);
        //     } else {
        //         //   app()->setLocale('en');
        //     }
        //     // dd("Service Provider");
        //     // dd(app()->getLocale());
        // });
    }
}
