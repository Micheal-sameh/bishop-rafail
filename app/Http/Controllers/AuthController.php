<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $loginValue = trim((string) $request->input('login'));
        $password = (string) $request->input('password');
        $remember = $request->boolean('remember');

        $authenticated = Auth::attempt([
            'email' => $loginValue,
            'password' => $password,
            'status' => UserStatus::ACTIVE,
        ], $remember);

        if (! $authenticated) {
            $authenticated = Auth::attempt([
                'phone' => $loginValue,
                'password' => $password,
                'status' => UserStatus::ACTIVE,
            ], $remember);
        }

        if (! $authenticated) {
            return back()
                ->withErrors(['login' => 'بيانات الدخول غير صحيحة.'])
                ->onlyInput('login');
        }

        $user = Auth::user();

        if (! $user || (int) $user->status !== UserStatus::ACTIVE) {
            Auth::logout();

            return back()
                ->withErrors(['login' => 'هذا الحساب غير مُفعّل، برجاء التواصل مع الإدارة.'])
                ->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('users.index'));
    }

    public function dashboard(Request $request): View
    {
        return view('dashboard.index', [
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
