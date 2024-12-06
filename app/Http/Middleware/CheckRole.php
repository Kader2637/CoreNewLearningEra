<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (in_array($request->route()->getName(), ['login', 'register' , 'register/teacher'])) {
                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('admin/dashboard');
                    case 'student':
                        return redirect()->route('student/dashboard');
                    case 'teacher':
                        return redirect()->route('teacher');
                    default:
                        return redirect('/');
                }
            }

            if (!in_array($user->role, $roles)) {
                $currentRoute = $request->route()->getName();

                switch ($user->role) {
                    case 'admin':
                        if ($currentRoute !== 'admin/dashboard') {
                            return redirect()->route('admin/dashboard');
                        }
                        break;
                    case 'student':
                        if ($currentRoute !== 'student/dashboard') {
                            return redirect()->route('student/dashboard');
                        }
                        break;
                    case 'teacher':
                        if ($currentRoute !== 'teacher') {
                            return redirect()->route('teacher');
                        }
                        break;
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
