<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Login - Nala Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nala-auth-page">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card nala-auth-card shadow border-0">
                    <div class="card-body p-5">
                        <p class="nala-eyebrow nala-eyebrow--dark">Nala Coffee</p>
                        <h1 class="h3 mb-2">Member Login</h1>
                        <p class="text-muted mb-4">Masuk untuk mengelola profil member Anda.</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{ route('member.login.submit') }}">
                            @csrf
                            <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required></div>
                            <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" name="password" id="password" required></div>
                            <button class="btn nala-btn nala-btn--dark w-100" type="submit">Masuk</button>
                        </form>
                        <p class="mt-4 mb-0 text-muted">Belum punya akun? <a href="{{ route('member.register') }}">Daftar member</a></p>
                        <a class="d-block mt-2" href="{{ route('home') }}">Kembali ke website</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
