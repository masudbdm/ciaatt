<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\WebsiteParameter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        $oneWeek = 60 * 60 * 24 * 7; // seconds

        $menusForAll = Cache::remember('menus_for_all', $oneWeek, function () {
            return Menu::all();
        });

        $categoriesForAll = Cache::remember('categories_for_all', $oneWeek, function () {
            return Category::all();
        });

        $postsRightSidebar = Cache::remember('posts_right_sidebar', $oneWeek, function () {
            return Post::where('publish_status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        $websiteParameter = Cache::remember('website_parameter', $oneWeek, function () {
            return WebsiteParameter::latest()->first();
        });

        view()->share([
            'menusForAll'       => $menusForAll,
            'categoriesForAll'  => $categoriesForAll,
            'postsRightSidebar' => $postsRightSidebar,
            'websiteParameter'  => $websiteParameter,
        ]);
    }
}
