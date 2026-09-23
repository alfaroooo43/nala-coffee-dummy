<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Nala Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nala-auth-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <img class="admin-auth__logo mb-3" src="{{ asset('images/nala-logo.png') }}" alt="Nala Coffee">
                        <h1 class="h3 mb-4">ADMIN LOGIN</h1>
                        <p class="text-muted">ADMIN LOGIN</p>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <button class="btn btn-outline-secondary" type="button" data-password-toggle="#password" aria-label="Tampilkan password">👁</button>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <button type="submit" class="btn nala-btn nala-btn--gold w-100">Masuk ke CMS</button>
                        </form>
                        <a href="{{ route('admin.register') }}" class="btn nala-btn nala-btn--outline w-100 mt-2">Register Admin</a>
                        <a href="{{ route('home') }}" class="d-block mt-3 text-center">← Kembali ke website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
