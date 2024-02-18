<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{ // ! reset password, remember on login
    public function __construct()
    {
        // $this->middleware('admin')->only(['users', 'update', 'edit']);
        $this->middleware('guest')->except(['logout', 'users', 'students', 'profile', 'edit', 'update']);
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function edit(User $user): View
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'min:3', 'max:50'], 'name' => ['required', 'min:3', 'max:50'],
        ]);

        $user->update([
            'name' => $request['name'], 'role' => $request['role'],
        ]);

        return redirect()->route('user.index');
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:5'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function users(): View
    {
        $title = 'users';
        $users = User::where('role', '!=', 'student')->paginate(10);
        return view('user.index', compact('users', 'title'));
    }

    public function students(): View
    {
        $title = 'students';
        $users = User::where('role', 'student')->paginate(10);
        return view('user.index', compact('users', 'title'));
    }

    public function profile(User $user): View
    {
        return view('dashboard.profile', compact('user'));
    }
}
