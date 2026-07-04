<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => ['customer', 'staff', 'admin'],
        ]);
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.users.form', [
            'user' => new User(),
            'roles' => ['customer', 'staff', 'admin'],
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,staff,admin',
            'status' => 'required|in:active,inactive',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công.');
    }

    public function edit(string $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        return view('admin.users.form', [
            'user' => $user,
            'roles' => ['customer', 'staff', 'admin'],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => "required|email|unique:users,email,{$user->id}",
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:customer,staff,admin',
            'status' => 'required|in:active,inactive',
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy(string $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công.');
    }
}
