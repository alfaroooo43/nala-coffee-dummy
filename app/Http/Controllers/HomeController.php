<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Setting;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        if (Schema::hasTable('website_visits')) {
            WebsiteVisit::create([
                'visitor_id' => $request->session()->getId(),
                'session_id' => $request->session()->getId(),
                'page' => '/',
                'referrer' => $request->headers->get('referer'),
                'device' => str_contains(strtolower((string) $request->userAgent()), 'mobile') ? 'mobile' : 'desktop',
                'browser' => $request->userAgent(),
                'ip_hash' => hash('sha256', (string) $request->ip()),
                'visited_at' => now(),
            ]);
        }
        $products = Schema::hasTable('products')
            ? Product::query()->where('status', 'active')->latest()->take(6)->get()
            : collect();

        $galleryImages = Schema::hasTable('galleries')
            ? Gallery::query()->where('status', 'active')->orderBy('sort_order')->get()
            : collect();

        if ($galleryImages->isEmpty()) {
            $galleryImages = collect(range(1, 6))
                ->map(fn (int $number): array => ['image' => "images/gallery/gallery-{$number}.png", 'title' => 'Galeri Nala Coffee'])
                ->all();
        }
        $articles = Schema::hasTable('articles')
            ? Article::where('status', 'published')->latest('published_at')->take(3)->get()
            : collect();
        $settings = Schema::hasTable('settings') ? Setting::query()->pluck('value', 'key') : collect();

        return view('home', compact('products', 'galleryImages', 'articles', 'settings'));
    }
}
