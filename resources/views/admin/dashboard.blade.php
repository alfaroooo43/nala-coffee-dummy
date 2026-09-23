@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Ringkasan website dan marketplace</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3"><div class="card shadow-sm border-0 h-100"><div class="card-body"><div class="text-muted small">Total Products</div><div class="fs-3 fw-bold">{{ $totalProducts }}</div></div></div></div>
        <div class="col-md-6 col-xl-3"><div class="card shadow-sm border-0 h-100"><div class="card-body"><div class="text-muted small">Total Gallery</div><div class="fs-3 fw-bold">{{ $totalGallery }}</div></div></div></div>
        <div class="col-md-6 col-xl-3"><div class="card shadow-sm border-0 h-100"><div class="card-body"><div class="text-muted small">Total Artikel</div><div class="fs-3 fw-bold">{{ $totalArticles }}</div></div></div></div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Members</div>
                    <div class="fs-3 fw-bold">{{ $totalMembers }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Partnerships</div>
                    <div class="fs-3 fw-bold">{{ $totalPartnerships }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Shopee Clicks</div>
                    <div class="fs-3 fw-bold">{{ $totalShopeeClicks }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
