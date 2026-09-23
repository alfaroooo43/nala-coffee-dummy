<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberAuthController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('member.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        $member = Member::where('email', $credentials['email'])->where('status', 'active')->first();

        if ($member === null || ! Auth::guard('member')->attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau password member tidak valid.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $member = Auth::guard('member')->user();
        $member->update(['last_active_at' => now()]);

        return redirect()->intended(route('member.dashboard'));
    }

    public function showRegistrationForm(): View|RedirectResponse
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        return view('member.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $member = Member::create([
            ...$validated,
            'registered_at' => now(),
            'last_active_at' => now(),
            'status' => 'active',
        ]);

        Auth::guard('member')->login($member);
        $request->session()->regenerate();

        return redirect()->route('member.dashboard')->with('success', 'Registrasi berhasil.');
    }

    public function dashboard(Request $request): View
    {
        $member = Auth::guard('member')->user();

        return view('member.dashboard', compact('member'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.login');
    }
}
