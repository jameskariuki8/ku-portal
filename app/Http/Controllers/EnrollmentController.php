<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        $studentId = Auth::id();

        // Check if student is already enrolled
        if (Enrollment::where('student_id', $studentId)->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        // Enroll the student
        Enrollment::create([
            'student_id' => $studentId,
            'course_id' => $course->id
        ]);

        return back()->with('success', 'Successfully enrolled in ' . $course->name);
    }
}
