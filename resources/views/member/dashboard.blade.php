<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Dashboard - Nala Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nala-auth-page">
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4"><div><p class="nala-eyebrow nala-eyebrow--dark mb-2">Nala Coffee</p><h1 class="h3">Halo, {{ $member->name }}</h1></div><form method="POST" action="{{ route('member.logout') }}">@csrf<button class="btn btn-outline-dark">Logout</button></form></div>
        @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <div class="card border-0 shadow-sm"><div class="card-body"><h2 class="h5">Profil Member</h2><dl class="row mb-0"><dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $member->email }}</dd><dt class="col-sm-3">Telepon</dt><dd class="col-sm-9">{{ $member->phone }}</dd><dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ ucfirst($member->status) }}</dd><dt class="col-sm-3">Terdaftar</dt><dd class="col-sm-9">{{ optional($member->registered_at)->format('d M Y') }}</dd></dl></div></div>
    </main>
</body>
</html>
