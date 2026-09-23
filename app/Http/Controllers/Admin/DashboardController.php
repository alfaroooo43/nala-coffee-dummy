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
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalVisitors = WebsiteVisit::count();
        $uniqueVisitors = WebsiteVisit::query()->distinct('visitor_id')->count('visitor_id');
        $totalSessions = WebsiteVisit::query()->distinct('session_id')->count('session_id');
        $totalProducts = Product::count();
        $totalMembers = Member::count();
        $totalPartnerships = Partnership::count();
        $totalShopeeClicks = MarketplaceClick::count();
        $totalGallery = Gallery::count();
        $totalArticles = Article::count();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'uniqueVisitors',
            'totalSessions',
            'totalProducts',
            'totalMembers',
            'totalPartnerships',
            'totalShopeeClicks',
            'totalGallery',
            'totalArticles',
        ));
    }
}
