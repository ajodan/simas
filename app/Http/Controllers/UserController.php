<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataJamaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index()
    {
        $module = 'Users';
        return view('admin.users.index', compact('module'));
    }

    public function get()
    {
        $data = User::with('dataJamaah')->get();
        return $this->sendResponse($data, 'Get users success');
    }

    public function add(Request $request)
    {
        $request->validate([
            'data_jamaah_id' => 'required|exists:data_jamaahs,id',
            'username' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        $jamaah = DataJamaah::findOrFail($request->data_jamaah_id);
        $data = User::create([
            'nama' => $jamaah->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'data_jamaah_id' => $request->data_jamaah_id,
        ]);

        return $this->sendResponse($data, 'Tambah Pengguna Berhasil');
    }

    public function show($params)
    {
        $data = User::with('dataJamaah')->where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('User not found', 'User not found', 404);
        }
        return $this->sendResponse($data, 'Get user success');
    }

    public function update(Request $request, $params)
    {
        $data = User::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('User not found', 'User not found', 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|email|max:255|unique:users,username,' . $data->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $data->update($updateData);
        return $this->sendResponse($data, 'Update user success');
    }

    public function delete($params)
    {
        $data = User::where('uuid', $params)->first();
        if (!$data) {
            return $this->sendError('User not found', 'User not found', 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Delete user success');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->sendError('Current password is incorrect', 'Current password is incorrect', 400);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return $this->sendResponse($user, 'Password changed successfully');
    }

    public function profile()
    {
        $user = auth()->user();
        $module = 'Profile';
        return view('user.profile.index', compact('user', 'module'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|email|max:255|unique:users,username,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
        ]);

        return $this->sendResponse($user, 'Profile updated successfully');
    }
}
