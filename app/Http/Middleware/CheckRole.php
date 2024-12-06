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
                switch ($user->role) {
                    case 'admin':
                        if ($user->role !== 'admin/dashboard') {
                            return redirect()->route('admin/dashboard');
                        }
                        break;
                    case 'student':
                        if ($user->role !== 'student/dashboard') {
                            return redirect()->route('student/dashboard');
                        }
                        break;
                    case 'teacher':
                        if ($user->role !== 'teacher') {
                            return redirect()->route('teacher');
                        }
                        break;
                    default:
                        return redirect('/');
                }
            }
        } else {
            return $next($request);
        }

        return $next($request);
    }
}
