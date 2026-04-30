<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteCacheService;
use Illuminate\Http\Request;

class AdminSiteCacheController extends Controller
{
    public function clear(Request $request)
    {
        SiteCacheService::flushSiteCaches();

        return back()->with('success', 'Site cache cleared.');
    }

    public function warm(Request $request)
    {
        SiteCacheService::warmSiteCaches();

        return back()->with('success', 'Site cache warmed.');
    }
}
