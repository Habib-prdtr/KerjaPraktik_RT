<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =============================
    // [ADMIN] Daftar semua user
    // =============================
    public function index(Request $request)
    {
        $query = User::with('warga');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    // =============================
    // [ADMIN] Form tambah user
    // =============================
    public function create()
    {
        // Warga yang belum memiliki akun
        $wargaList = Warga::where('status', 'aktif')
            ->whereDoesntHave('user')
            ->orderBy('nama')
            ->get();

        return view('admin.user.create', compact('wargaList'));
    }

    // =============================
    // [ADMIN] Simpan user baru
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,warga',
            'warga_id' => 'nullable|exists:warga,id|unique:users,warga_id',
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'role.required'     => 'Role wajib dipilih.',
            'warga_id.unique'   => 'Warga ini sudah memiliki akun.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'warga_id' => $request->warga_id,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // =============================
    // [ADMIN] Detail user
    // =============================
    public function show(User $user)
    {
        $user->load('warga.kartuKeluarga');
        return view('admin.user.show', compact('user'));
    }

    // =============================
    // [ADMIN] Form edit user
    // =============================
    public function edit(User $user)
    {
        $wargaList = Warga::where('status', 'aktif')
            ->where(function ($q) use ($user) {
                $q->whereDoesntHave('user')
                  ->orWhereHas('user', fn($u) => $u->where('id', $user->id));
            })
            ->orderBy('nama')
            ->get();

        return view('admin.user.edit', compact('user', 'wargaList'));
    }

    // =============================
    // [ADMIN] Update user
    // =============================
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,warga',
            'warga_id' => 'nullable|exists:warga,id|unique:users,warga_id,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique'   => 'Email sudah digunakan.',
            'role.required'  => 'Role wajib dipilih.',
            'password.min'   => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'warga_id' => $request->warga_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // =============================
    // [ADMIN] Hapus user
    // =============================
    public function destroy(User $user)
    {
        // Tidak boleh menghapus diri sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    // =============================
    // [SEMUA] Halaman profil user yang login
    // =============================
    public function profile()
    {
        $user = Auth::user()->load('warga.kartuKeluarga');
        return view('profile', compact('user'));
    }

    // =============================
    // [SEMUA] Update profil
    // =============================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
