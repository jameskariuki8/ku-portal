<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    // Show the add course form
    public function showAddCourseForm()
    {
        return view('admin.add-course'); // Ensure you have this view file
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:courses,name',
        ]);

        Course::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.units')->with('success', 'Course added successfully.');
    }

    // Student enrollment method
    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = auth()->user(); // Get the authenticated user
        $courseId = $request->course_id;

        // Check if the student is already enrolled
        if ($student->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Enroll the student
        $student->courses()->attach($courseId);

        return redirect()->route('student.dashboard')->with('success', 'Successfully enrolled in the course.');
    }
}
