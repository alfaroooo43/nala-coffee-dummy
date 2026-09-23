<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null) {
            return redirect()->route('admin.login');
        }

        if ($user->status !== 'active' || ! in_array($user->role, ['super_admin', 'content_admin', 'marketing'], true)) {
            abort(403);
        }

        $lastActivity = (int) $request->session()->get('admin.last_activity', 0);
        if ($lastActivity > 0 && now()->timestamp - $lastActivity >= (int) config('app.admin_session_timeout', 300)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Sesi admin berakhir setelah 5 menit tanpa aktivitas.',
            ]);
        }
        $request->session()->put('admin.last_activity', now()->timestamp);

        $path = $request->path();
        $contentPaths = str_starts_with($path, 'admin/products')
            || str_starts_with($path, 'admin/gallery')
            || str_starts_with($path, 'admin/articles');
        $marketingPaths = str_starts_with($path, 'admin/members')
            || str_starts_with($path, 'admin/partnerships')
            || str_starts_with($path, 'admin/analytics')
            || str_starts_with($path, 'admin/reports');
        if (($user->role === 'content_admin' && ! $contentPaths && $path !== 'admin/dashboard') || ($user->role === 'marketing' && ! $marketingPaths && $path !== 'admin/dashboard')) {
            abort(403);
        }

        return $next($request);
    }
}
