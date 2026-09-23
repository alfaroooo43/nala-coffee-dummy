<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NALA COFFEE CMS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell">
    <div class="container-fluid px-0">
        <div class="row g-0 min-vh-100">
            <aside class="col-lg-2 admin-sidebar">
                <a class="admin-sidebar__brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/nala-logo.png') }}" alt="Nala Coffee"><strong>NALA COFFEE<small>CMS / ROASTERY</small></strong></a>
                <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">⌂ &nbsp; Dashboard</a>
                    <div class="admin-sidebar__label">Content</div>
                    @if (in_array(auth()->user()->role, ['super_admin', 'content_admin'], true))
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Kopi / Produk</a>
                        <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">Gallery</a>
                        <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Artikel</a>
                    @endif
                    <div class="admin-sidebar__label">Business</div>
                    @if (in_array(auth()->user()->role, ['super_admin', 'marketing'], true))
                        <a href="{{ route('admin.members.index') }}" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">Member</a>
                        <a href="{{ route('admin.partnerships.index') }}" class="nav-link {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">Kemitraan</a>
                    @endif
                    <div class="admin-sidebar__label">Analytics</div>
                    @if (in_array(auth()->user()->role, ['super_admin', 'marketing'], true))
                        <a href="{{ route('admin.analytics.website') }}" class="nav-link {{ request()->routeIs('admin.analytics.website') ? 'active' : '' }}">Website</a>
                        <a href="{{ route('admin.analytics.marketplace') }}" class="nav-link {{ request()->routeIs('admin.analytics.marketplace') ? 'active' : '' }}">Marketplace</a>
                        <a href="{{ route('admin.analytics.members') }}" class="nav-link {{ request()->routeIs('admin.analytics.members') ? 'active' : '' }}">Member</a>
                        <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">Laporan</a>
                    @endif
                    <div class="admin-sidebar__label">System</div>
                    @if (auth()->user()->role === 'super_admin')
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Admin / User</a>
                        <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">Pengaturan</a>
                    @endif
                    <div class="mt-4 pt-3 border-top" style="border-color: var(--nala-line) !important;">
                        <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">↪ &nbsp; Logout</button></form>
                    </div>
                </nav>
            </aside>
            <main class="col-lg-10 admin-main">
                <header class="admin-topbar"><span class="admin-topbar__eyebrow">Nala Coffee / Workspace</span><span class="admin-topbar__user">{{ auth()->user()->name }} &nbsp;·&nbsp; {{ str_replace('_', ' ', auth()->user()->role) }}</span></header>
                <div class="admin-content">
                    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
