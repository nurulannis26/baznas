<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.welcome');
    }

    public function home()
    {
        return view('auth.home');
    }

    public function verifikasi(Request $request)
{
    $request->validate([
        'nohp' => 'required|numeric',
        'password' => 'required'
    ]);

    $user = Pengguna::where('nohp', $request->nohp)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return redirect(route('login'))->with('pesan', 'Username atau password salah');
    }

    Auth::login($user, false);
    $request->session()->regenerate(); // Regenerate session untuk mencegah session fixation

    return redirect('/home');
}


public function logout(Request $request)
{
    // dd('baba');
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect(route('login'));
}
}
