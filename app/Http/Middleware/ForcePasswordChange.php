<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $user = $request->user();

        if (! $user || ! $user->must_change_password) {
            return $next($request);
        }

        $allowedRoutes = [
            'profile',
            'profile.update',
            'logout',
            'password.forgot',
            'password.email',
            'password.reset',
            'password.update',
        ];

        if ($request->route() && in_array($request->route()->getName(), $allowedRoutes, true)) {
            return $next($request);
        }

        return redirect()
            ->route('profile')
            ->withErrors(['password' => 'يجب تحديث كلمة المرور عند أول تسجيل دخول.']);
    }
}
