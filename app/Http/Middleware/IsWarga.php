<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsWarga
{
    /**
     * Hanya izinkan user dengan role 'warga'.
     * Jika admin mencoba akses halaman warga, redirect ke dashboard admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'warga') {
            return redirect()->route('admin.dashboard')
                ->with('info', 'Anda sudah login sebagai admin.');
        }

        return $next($request);
    }
}
