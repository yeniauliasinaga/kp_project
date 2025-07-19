<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Pastikan user memiliki pegawai
        if (!auth()->user()->pegawai) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun tidak memiliki hak akses.',
            ]);
        }
        // Redirect berdasarkan role
        return auth()->user()->pegawai->role === 'superadmin'
            ? redirect()->route('superadmin.dashboard')
            : redirect()->route('staff.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get the post-login redirect path based on user role.
     */
    protected function redirectTo()
    {
        if (auth()->user()->pegawai->role === 'superadmin') {
            return route('superadmin.dashboard');
        }
        
        return route('staff.dashboard');
    }
}