<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\SubCategory;
use App\Services\SiteCacheService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class SeoController extends Controller
{
    public function sitemap()
    {
        $xml = Cache::remember(SiteCacheService::KEY_SITEMAP_XML, now()->addHours(6), function () {
            return $this->buildSitemapXml();
        });

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    public function robots()
    {
        $sitemap = route('sitemap');

        $lines = [
            'User-agent: *',
            'Disallow:',
            '',
            'Sitemap: '.$sitemap,
            '',
            '# AI / LLM discovery',
            'User-agent: GPTBot',
            'Allow: /',
            '',
            'User-agent: ChatGPT-User',
            'Allow: /',
            '',
            'User-agent: Google-Extended',
            'Allow: /',
            '',
            'User-agent: anthropic-ai',
            'Allow: /',
            '',
            'User-agent: Claude-Web',
            'Allow: /',
            '',
            'User-agent: PerplexityBot',
            'Allow: /',
        ];

        return Response::make(implode("\n", $lines), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    /**
     * llms.txt — machine-readable site summary for AI crawlers (see llmstxt.org).
     */
    public function llms()
    {
        $name = config('app.name', 'Website');
        $url = rtrim(config('app.url'), '/');

        $body = implode("\n", [
            '# '.$name,
            '',
            '## Site',
            '- Name: '.$name,
            '- URL: '.$url,
            '',
            '## Discovery',
            '- Sitemap: '.$url.'/sitemap.xml',
            '- Robots: '.$url.'/robots.txt',
            '',
            '## Contact',
            '- Human contact: '.$url.'/contact-us',
            '',
        ]);

        return Response::make($body, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    private function buildSitemapXml(): string
    {
        $base = rtrim(config('app.url'), '/');

        $entries = [];

        $add = function (string $loc, string $changefreq = 'weekly', string $priority = '0.8') use (&$entries) {
            $entries[] = [
                'loc' => $loc,
                'changefreq' => $changefreq,
                'priority' => $priority,
            ];
        };

        $add($base.'/', 'daily', '1.0');
        $add(route('user.categories'), 'weekly', '0.9');
        $add(route('user.contactUs'), 'monthly', '0.6');
        $add(route('user.teams'), 'weekly', '0.7');

        foreach (Category::query()->orderBy('drag_id')->get() as $category) {
            $add(route('user.categoryDetails', $category), 'weekly', '0.8');
        }

        foreach (SubCategory::query()->orderBy('id')->get() as $subcategory) {
            $add(route('user.subcategoryDetails', $subcategory), 'weekly', '0.75');
        }

        foreach (Page::query()->orderBy('drag_id')->get() as $page) {
            $add(route('user.pageDetails', ['url' => $page->slug, 'page' => $page->id]), 'monthly', '0.7');
        }

        foreach (Post::query()->where('publish_status', 'published')->orderByDesc('updated_at')->get() as $post) {
            $titleRaw = $post->title;
            if (is_array($titleRaw)) {
                $titleRaw = $titleRaw[app()->getLocale()] ?? reset($titleRaw) ?? '';
            }
            $slug = Str::slug(strip_tags((string) $titleRaw));
            $add(route('user.postDetails', [$post, $slug]), 'weekly', '0.8');
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($entries as $e) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.htmlspecialchars($e['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8').'</loc>'."\n";
            $xml .= '    <changefreq>'.$e['changefreq'].'</changefreq>'."\n";
            $xml .= '    <priority>'.$e['priority'].'</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
