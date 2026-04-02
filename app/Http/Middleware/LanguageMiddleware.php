<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (Auth::check()) {
        //     App::setLocale(Auth::user()->language);
        // }elseif(Cookie::has('lan')){
        //     $dcrypt_cookie = Crypt::decrypt(Cookie::get('lan'), false);
        //     $ex = explode('|', $dcrypt_cookie);
        //     $locale = $ex[1];
        //     App::setLocale($locale);
        // }else{
        //     App::setLocale('en');  
        // }
        // Cookie::queue('selectedLan',App::getLocale(),120000);
        // // Cookie::make('selectedLan',);
        // // dd( App::getLocale());
        // return $next($request);
    }
}
