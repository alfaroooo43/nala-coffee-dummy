<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user?->status === 'active' && in_array($user->role, ['super_admin', 'content_admin', 'marketing'], true)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            ...$credentials,
            'status' => 'active',
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();
            $request->session()->put('admin.last_activity', now()->timestamp);

            if (! in_array(Auth::user()->role, ['super_admin', 'content_admin', 'marketing'], true)) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki akses admin.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial admin tidak valid.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm(): View
    {
        return view('admin.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'registration_key' => ['required', 'string'],
        ]);

        $configuredKey = (string) config('app.admin_register_key', '');
        if ($configuredKey === '' || ! hash_equals($configuredKey, (string) $request->string('registration_key'))) {
            return back()->withErrors(['registration_key' => 'Kunci registrasi admin tidak valid.'])->withInput();
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'content_admin',
            'status' => 'active',
        ]);

        return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
