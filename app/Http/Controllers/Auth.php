<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth as RequestsAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class Auth extends BaseController
{
    public function show()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['captcha' => $num1 + $num2]);
        return view('auth.login', compact('num1', 'num2'));
    }

    public function login_proses(RequestsAuth $authRequest)
    {
        $credential = $authRequest->getCredentials();

        if ($authRequest->captcha_answer != session('captcha')) {
            return redirect()->route('login.login-akun')->with('failed', 'Captcha salah');
        }

        if (!FacadesAuth::attempt($credential)) {
            return redirect()->route('login.login-akun')->with('failed', 'Username atau Password salah');
        } else {
            return redirect()->route('admin.dashboard-admin')->with('success', 'Berhasil Login');
        }
    }

    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('login.login-akun')->with('success', 'Berhasil Logout');
    }
}
