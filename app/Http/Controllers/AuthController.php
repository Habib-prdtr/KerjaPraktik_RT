<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =============================
    // Tampilkan form login
    // =============================
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    // =============================
    // Proses login
    // =============================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    // =============================
    // Proses logout
    // =============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    // =============================
    // Tampilkan form register (opsional untuk warga)
    // =============================
    public function showRegister()
    {
        $wargaList = Warga::where('status', 'aktif')
            ->whereDoesntHave('user') // belum punya akun
            ->orderBy('nama')
            ->get();

        return view('auth.register', compact('wargaList'));
    }

    // =============================
    // Proses register
    // =============================
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
            'warga_id'  => 'required|exists:warga,id|unique:users,warga_id',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'warga_id.required'  => 'Warga wajib dipilih.',
            'warga_id.exists'    => 'Data warga tidak ditemukan.',
            'warga_id.unique'    => 'Warga ini sudah memiliki akun.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'warga',
            'warga_id' => $request->warga_id,
        ]);

        Auth::login($user);

        return redirect()->route('warga.dashboard')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }

    // =============================
    // Helper: redirect berdasarkan role
    // =============================
    private function redirectByRole()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('warga.dashboard');
    }
}
