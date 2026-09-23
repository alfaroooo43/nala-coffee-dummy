<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nala Coffee Dummy adalah landing page company profile untuk kebutuhan belajar Laravel.">
    <title>@yield('title', 'Nala Coffee Dummy')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="nala-page">
        @include('partials.navbar')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
