<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Register - Nala Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nala-auth-page">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card nala-auth-card shadow border-0">
                    <div class="card-body p-5">
                        <p class="nala-eyebrow nala-eyebrow--dark">Nala Coffee</p>
                        <h1 class="h3 mb-2">Daftar Member</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                        @endif
                        <form method="POST" action="{{ route('member.register.submit') }}">
                            @csrf
                            <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
                            <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required></div>
                            <div class="mb-3"><label class="form-label">Telepon</label><input class="form-control" name="phone" value="{{ old('phone') }}" required></div>
                            <div class="row g-3"><div class="col-md-6"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div><div class="col-md-6"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" required></div></div>
                            <button class="btn nala-btn nala-btn--dark w-100 mt-4" type="submit">Daftar</button>
                        </form>
                        <p class="mt-4 mb-0 text-muted">Sudah punya akun? <a href="{{ route('member.login') }}">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
