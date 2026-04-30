<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\WebsiteParameter;
use Illuminate\Support\Facades\Cache;

/**
 * Central site cache: shared view data, home, category/post/page views, sitemap.
 * Set CACHE_DRIVER=redis in production for best performance.
 */
class SiteCacheService
{
    public const KEY_MENUS = 'menus_for_all';

    public const KEY_CATEGORIES_FOR_ALL = 'categories_for_all';

    public const KEY_POSTS_RIGHT_SIDEBAR = 'posts_right_sidebar';

    public const KEY_WEBSITE_PARAMETER = 'website_parameter';

    public const KEY_HOME_CATEGORIES_POST = 'home_categories_post';

    public const KEY_HOME_CATEGORIES = 'home_categories';

    public const KEY_HOME_POST_CATEGORIES = 'home_post_categories';

    public const KEY_HOME_POSTS_RANDOM_24 = 'home_posts_random_24';

    public const KEY_HOME_PAGES = 'home_pages';

    public const KEY_FEATURED_TEAMS = 'featured_teams';

    public const KEY_TEAMS = 'teams';

    public const KEY_SITEMAP_XML = 'sitemap_xml';

    public static function ttl(): \DateTimeInterface
    {
        return now()->addDays(7);
    }

    public static function postShowKey(int $postId): string
    {
        return 'post_show_'.$postId;
    }

    public static function categoryShowKey(int $categoryId): string
    {
        return 'category_show_'.$categoryId;
    }

    public static function subcategoryShowKey(int $subcategoryId): string
    {
        return 'subcategory_show_'.$subcategoryId;
    }

    public static function pageShowKey(int $pageId): string
    {
        return 'page_show_'.$pageId;
    }

    public static function menusForAll()
    {
        return Cache::remember(self::KEY_MENUS, self::ttl(), function () {
            return Menu::all();
        });
    }

    public static function categoriesForAll()
    {
        return Cache::remember(self::KEY_CATEGORIES_FOR_ALL, self::ttl(), function () {
            return Category::all();
        });
    }

    public static function postsRightSidebar()
    {
        return Cache::remember(self::KEY_POSTS_RIGHT_SIDEBAR, self::ttl(), function () {
            return Post::where('publish_status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });
    }

    public static function websiteParameter(): ?WebsiteParameter
    {
        return Cache::remember(self::KEY_WEBSITE_PARAMETER, self::ttl(), function () {
            return WebsiteParameter::latest()->first();
        });
    }

    public static function homeCategoriesPost()
    {
        return Cache::remember(self::KEY_HOME_CATEGORIES_POST, self::ttl(), function () {
            return Category::whereHas('posts', function ($query) {
                $query->where('publish_status', 'published');
                $query->where('front_slider', true);
            })
                ->with(['posts' => function ($query) {
                    $query->where('publish_status', 'published');
                    $query->where('front_slider', true);
                }])
                ->orderBy('drag_id')
                ->get();
        });
    }

    public static function homeCategories()
    {
        return Cache::remember(self::KEY_HOME_CATEGORIES, self::ttl(), function () {
            return Category::orderBy('drag_id')->get();
        });
    }

    public static function homePostCategories()
    {
        return Cache::remember(self::KEY_HOME_POST_CATEGORIES, self::ttl(), function () {
            return PostCategory::all();
        });
    }

    public static function homePostsRandom24()
    {
        return Cache::remember(self::KEY_HOME_POSTS_RANDOM_24, self::ttl(), function () {
            return Post::where('publish_status', 'published')
                ->inRandomOrder()
                ->limit(24)
                ->get();
        });
    }

    public static function homePages()
    {
        return Cache::remember(self::KEY_HOME_PAGES, self::ttl(), function () {
            return Page::orderBy('drag_id')->get();
        });
    }

    public static function featuredTeams()
    {
        return Cache::remember(self::KEY_FEATURED_TEAMS, self::ttl(), function () {
            return Team::where('status', 1)
                ->where('featured', 1)
                ->orderByRaw('drag_id IS NULL, drag_id ASC')
                ->limit(4)
                ->get();
        });
    }

    public static function teamsList()
    {
        return Cache::remember(self::KEY_TEAMS, self::ttl(), function () {
            return Team::where('status', 1)
                ->orderByRaw('drag_id IS NULL, drag_id ASC')
                ->get();
        });
    }

    /**
     * Forget all site caches (shared views, home, per-entity, sitemap).
     */
    public static function flushSiteCaches(): void
    {
        $static = [
            self::KEY_MENUS,
            self::KEY_CATEGORIES_FOR_ALL,
            self::KEY_POSTS_RIGHT_SIDEBAR,
            self::KEY_WEBSITE_PARAMETER,
            self::KEY_HOME_CATEGORIES_POST,
            self::KEY_HOME_CATEGORIES,
            self::KEY_HOME_POST_CATEGORIES,
            self::KEY_HOME_POSTS_RANDOM_24,
            self::KEY_HOME_PAGES,
            self::KEY_FEATURED_TEAMS,
            self::KEY_TEAMS,
            self::KEY_SITEMAP_XML,
        ];

        foreach ($static as $key) {
            Cache::forget($key);
        }

        foreach (Post::query()->pluck('id') as $id) {
            Cache::forget(self::postShowKey((int) $id));
        }

        foreach (Category::query()->pluck('id') as $id) {
            Cache::forget(self::categoryShowKey((int) $id));
        }

        foreach (SubCategory::query()->pluck('id') as $id) {
            Cache::forget(self::subcategoryShowKey((int) $id));
        }

        foreach (Page::query()->pluck('id') as $id) {
            Cache::forget(self::pageShowKey((int) $id));
        }
    }

    /**
     * Pre-warm frequently used cache entries (after clear or deploy).
     */
    public static function warmSiteCaches(): void
    {
        self::menusForAll();
        self::categoriesForAll();
        self::postsRightSidebar();
        self::websiteParameter();
        self::homeCategoriesPost();
        self::homeCategories();
        self::homePostCategories();
        self::homePostsRandom24();
        self::homePages();
        self::featuredTeams();
        self::teamsList();
    }
}
