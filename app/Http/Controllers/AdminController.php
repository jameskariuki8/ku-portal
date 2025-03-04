<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $teachersCount = User::where('role', 'teacher')->count();
        $unitsCount = Unit::count();

        return view('admin.dashboard', compact('teachersCount', 'unitsCount'));
    }

    // View all registered teachers
    public function viewTeachers()
{
    $teachers = User::where('role', 'teacher')->get();
    $teachersCount = $teachers->count(); // Count the teachers
    $unitsCount = Unit::count(); // Count the units
    return view('admin.teachers', compact('teachers', 'teachersCount', 'unitsCount'));
}

    // View all units
    public function viewUnits()
    {
        $units = Unit::with(['teacher', 'course'])->get(); // Ensure relationships are loaded
        return view('admin.units', compact('units'));
    }

    // Show the form to add a new teacher
    public function showTeacherForm()
    {
        return view('admin.add-teacher'); // Ensure this view exists in resources/views/admin/
    }

    // Store a new teacher
    public function storeTeacher(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create the teacher
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password123'), // Default password
            'role' => 'teacher',
        ]);

        return redirect()->route('admin.teachers')->with('success', 'Teacher added successfully!');
    }
    public function showAddCourse()
{
    return view('admin.add-course');
}

}
