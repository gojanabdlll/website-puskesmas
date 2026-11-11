<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LOGIN ADMIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        // Jika sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        // Validasi
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'min:6',
            ],
        ], [

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 6 karakter.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            return redirect()
                ->intended(route('admin.dashboard'))
                ->with(
                    'success',
                    'Selamat datang di Dashboard Admin Puskesmas Singaparna.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN GAGAL
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput($request->only('email', 'remember'))
            ->with(
                'error',
                'Email atau password yang Anda masukkan salah.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil keluar dari sistem.'
            );
    }
}