<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!in_array($user->role, $roles)) {
                $roleRedirects = [
                    'admin' => route('admin.dashboard'),
                    'student' => route('student/dashboard'),
                    'teacher' => route('teacher'),
                ];
                if (isset($roleRedirects[$user->role]) && $roleRedirects[$user->role] !== $request->url()) {
                    return redirect($roleRedirects[$user->role]);
                }
            }
        } else {
            return $next($request);
        }
        return $next($request);
    }
}
