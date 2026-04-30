<?php

namespace App\Providers;

use App\Services\SiteCacheService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        $menusForAll = SiteCacheService::menusForAll();

        $categoriesForAll = SiteCacheService::categoriesForAll();

        $postsRightSidebar = SiteCacheService::postsRightSidebar();

        $websiteParameter = SiteCacheService::websiteParameter();

        view()->share([
            'menusForAll'       => $menusForAll,
            'categoriesForAll'  => $categoriesForAll,
            'postsRightSidebar' => $postsRightSidebar,
            'websiteParameter'  => $websiteParameter,
        ]);
    }
}
