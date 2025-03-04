<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:student,teacher,admin', // Ensure role is selected
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'These credentials do not match our records.']);
        }

        // 🔹 Debugging: Check stored vs. selected role
        if ($user->role !== $request->role) {
            return back()->withErrors([
                'role' => 'You cannot log in as ' . ucfirst($request->role) . '. Your actual role is ' . ucfirst($user->role) . '.',
            ]);
        }

        // **Authenticate user only if credentials & role match**
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Redirect based on role
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'teacher' => redirect()->route('teacher.dashboard'),
                'student' => redirect()->route('dashboard'),
                default => redirect()->route('home'),
            };
        }

        return back()->withErrors(['password' => 'Incorrect password.']);
    }
}
