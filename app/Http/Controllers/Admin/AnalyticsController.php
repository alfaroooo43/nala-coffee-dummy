<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\MarketplaceClick;
use App\Models\Member;
use App\Models\Partnership;
use App\Models\Product;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function website(Request $request): View
    {
        [$start, $end] = $this->range($request);
        $visits = WebsiteVisit::whereBetween('visited_at', [$start, $end]);

        return view('admin.analytics', [
            'title' => 'Analitik Website',
            'metrics' => [
                'Pengunjung' => $visits->count(),
                'Pengunjung unik' => (clone $visits)->distinct('visitor_id')->count('visitor_id'),
                'Sesi' => (clone $visits)->distinct('session_id')->count('session_id'),
                'Page views' => (clone $visits)->count('page'),
            ],
            'rows' => (clone $visits)->latest('visited_at')->limit(50)->get(),
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function marketplace(Request $request): View
    {
        [$start, $end] = $this->range($request);
        $clicks = MarketplaceClick::with('product')->whereBetween('clicked_at', [$start, $end]);

        return view('admin.analytics', [
            'title' => 'Analitik Marketplace',
            'metrics' => ['Total Shopee clicks' => $clicks->count(), 'Produk dengan klik' => (clone $clicks)->distinct('product_id')->count('product_id')],
            'rows' => (clone $clicks)->latest('clicked_at')->limit(50)->get(),
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function members(Request $request): View
    {
        [$start, $end] = $this->range($request);
        $newMembers = Member::whereBetween('registered_at', [$start, $end])->count();
        $uniqueVisitors = WebsiteVisit::whereBetween('visited_at', [$start, $end])->distinct('visitor_id')->count('visitor_id');

        return view('admin.analytics', [
            'title' => 'Analitik Member',
            'metrics' => [
                'Total member' => Member::count(),
                'Member baru' => $newMembers,
                'Member aktif' => Member::where('status', 'active')->count(),
                'Member nonaktif' => Member::whereIn('status', ['inactive', 'blocked'])->count(),
                'Registration rate' => $uniqueVisitors > 0 ? number_format(($newMembers / $uniqueVisitors) * 100, 2).'%' : '0%',
            ],
            'rows' => Member::whereBetween('registered_at', [$start, $end])->latest('registered_at')->limit(50)->get(),
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function reports(Request $request): View
    {
        [$start, $end] = $this->range($request);
        $metrics = [
            'Website visits' => WebsiteVisit::whereBetween('visited_at', [$start, $end])->count(),
            'Marketplace clicks' => MarketplaceClick::whereBetween('clicked_at', [$start, $end])->count(),
            'Members registered' => Member::whereBetween('registered_at', [$start, $end])->count(),
            'Products' => Product::count(),
            'Partnerships' => Partnership::whereBetween('created_at', [$start, $end])->count(),
            'Articles published' => Article::where('status', 'published')->whereBetween('published_at', [$start, $end])->count(),
            'Gallery items' => Gallery::count(),
        ];

        return view('admin.analytics', ['title' => 'Laporan', 'metrics' => $metrics, 'rows' => collect(), 'start' => $start, 'end' => $end]);
    }

    private function range(Request $request): array
    {
        $end = $request->filled('end_date') ? Carbon::parse((string) $request->input('end_date'))->endOfDay() : now()->endOfDay();
        $start = $request->filled('start_date') ? Carbon::parse((string) $request->input('start_date'))->startOfDay() : now()->subDays(29)->startOfDay();

        return [$start, $end];
    }
}
