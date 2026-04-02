<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\WebsiteParameter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $websiteParameter;
    public function __construct()
    {
        $this->websiteParameter = WebsiteParameter::first();
    }

    public function getLang()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->language;
        } elseif (Cookie::has('lang')) {
            Cookie::get('lang');
            dd(Cookie::get('lang'));
        } else {
            return config('locale');
        }
    }
    public function setLang($lang)
    {
        Cookie::queue('lang', $lang, 1000000);
        if (Auth::check()) {
            $user = Auth::user();
            $user->language = $lang;
            $user->save();
        }
    }
}
