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
        return view('auth.login');
    }

    public function login_proses(RequestsAuth $authRequest)
    {
        $credential = $authRequest->getCredentials();

        if (!FacadesAuth::attempt($credential)) {
           // return response()->json(['success' => false, 'message' => 'Username atau Password salah'], 401);
            return redirect()->route('login.login-akun')->with('error', 'Username atau Password salah');
        } else {
            $user = auth()->user();
            $token = $user->createToken('token')->plainTextToken;
         //   return response()->json(['success' => true, 'user' => $user, 'token' => $token]);
            return redirect()->route('admin.dashboard-admin')->with('success', 'Berhasil Login');
        }
    }

    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('login.login-akun')->with('success', 'Berhasil Logout');
    }
}
