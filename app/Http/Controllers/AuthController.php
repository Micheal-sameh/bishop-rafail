<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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

        if ((bool) $user->must_change_password) {
            return redirect()->route('profile')->withErrors([
                'password' => 'يجب تحديث كلمة المرور عند أول تسجيل دخول.',
            ]);
        }

        return redirect()->intended(route('users.index'));
    }

    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetPassword(Request $request, string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->validated(),
            function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'must_change_password' => false,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
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
