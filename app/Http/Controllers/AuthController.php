<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthController
 * 
 * Menangani otentikasi pengguna termasuk login dan logout.
 * Menyediakan form login dan memproses kredensial user.
 * 
 * @author Development Team
 * @version 1.0
 */
class AuthController extends Controller
{
    /**
     * Show the login form.
     * 
     * Menampilkan halaman form login ke user yang belum authenticated.
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     * 
     * Memvalidasi email dan password, kemudian melakukan autentikasi.
     * Jika berhasil, session di-regenerate untuk keamanan dan user diarahkan ke dashboard.
     * Jika gagal, user dikembalikan ke form dengan pesan error.
     * 
     * @param Request $request Request dengan email dan password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     * 
     * Menghapus session user, invalidate token, dan arahkan ke login page.
     * Proses ini memastikan user benar-benar logout dan session dibersihkan.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
