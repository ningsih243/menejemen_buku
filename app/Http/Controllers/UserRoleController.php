<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->get();
        $roles = Role::orderBy('name')->pluck('name');
        return view('users.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Admin tidak boleh menurunkan role dirinya sendiri (supaya tidak terkunci)
        if ($user->id === $request->user()->id && $data['role'] !== 'Admin') {
            return back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $user->syncRoles([$data['role']]);

        return back()->with('success', "Role {$user->name} diubah menjadi {$data['role']}.");
    }
}