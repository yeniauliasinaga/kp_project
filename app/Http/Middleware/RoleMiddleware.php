<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        if (!$user || !$user->pegawai) {
            abort(403, 'Tidak memiliki akses.');
        }

        // Log untuk debugging
        \Log::info('Cek Role', [
            'user_id' => $user->id,
            'role_user' => $user->pegawai->role,
            'role_dibutuhkan' => $role
        ]);

        // Superadmin bisa akses semua
        if ($user->pegawai->role === 'superadmin') {
            return $next($request);
        }

        // Cek role spesifik
        if ($user->pegawai->role !== $role) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
