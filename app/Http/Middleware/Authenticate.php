<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $role = $request->route()->getName(); // Get current route

        // Ensure users cannot access unauthorized sections
        if (($role === 'admin.dashboard' && $user->role !== 'admin') ||
            ($role === 'teacher.dashboard' && $user->role !== 'teacher') ||
            ($role === 'dashboard' && $user->role !== 'student')) {
            return redirect()->route('login')->withErrors(['role' => 'Unauthorized access!']);
        }

        return $next($request);
    }
}
