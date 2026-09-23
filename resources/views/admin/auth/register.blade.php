<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Register - Nala Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nala-auth-page">
    <main class="container py-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card nala-auth-card shadow border-0"><div class="card-body p-5">
        <img class="admin-auth__logo mb-3" src="{{ asset('images/nala-logo.png') }}" alt="Nala Coffee"><p class="nala-eyebrow nala-eyebrow--dark">Nala Coffee</p><h1 class="h3">Admin Registration</h1><p class="text-muted">Gunakan kunci undangan dari administrator.</p>
        @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ route('admin.register.submit') }}">@csrf
            <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required></div>
            <div class="mb-3"><label class="form-label">Kunci Registrasi</label><input class="form-control" name="registration_key" required></div>
            <div class="row g-3"><div class="col-md-6"><label class="form-label">Password</label><div class="input-group"><input class="form-control" type="password" name="password" id="admin-password" required><button class="btn btn-outline-secondary" type="button" data-password-toggle="#admin-password" aria-label="Tampilkan password">👁</button></div></div><div class="col-md-6"><label class="form-label">Konfirmasi</label><div class="input-group"><input class="form-control" type="password" name="password_confirmation" id="admin-password-confirmation" required><button class="btn btn-outline-secondary" type="button" data-password-toggle="#admin-password-confirmation" aria-label="Tampilkan password">👁</button></div></div></div>
            <button class="btn nala-btn nala-btn--dark w-100 mt-4">Daftar Admin</button>
        </form>
        <a class="d-block mt-3" href="{{ route('admin.login') }}">Kembali ke login</a>
    </div></div></div></div></main>
</body></html>
