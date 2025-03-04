<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Course;
use Illuminate\Support\Facades\Auth; // Import Auth for teacher_id

class UnitController extends Controller
{
    // Show form to create a new unit
    public function create()
    {
        $courses = Course::all(); // Fetch all courses for the dropdown
        $units = Unit::with('course')->get();
        return view('teacher.create', compact('courses', 'units'));
    }

    // Display all units
    public function index()
    {
        $units = Unit::with('course', 'teacher')->get();
        $courses = Course::all(); // Pass courses to the view

        return view('teacher.units.index', compact('units', 'courses'));
    }

    // Store a new unit
    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|string|max:255',
            'unit_code' => 'required|string|max:20|unique:units,code',
            'course_id' => 'required|exists:courses,id',
        ]);

        Unit::create([
            'name' => $request->unit_name, // Ensure correct field name
            'code' => $request->unit_code,
            'course_id' => $request->course_id,
            'teacher_id' => Auth::id(), // Store the currently logged-in teacher
        ]);

        return redirect()->route('teacher.units.index')->with('success', 'Unit added successfully.');
    }
}
