<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Result;
use App\Models\UnitRegistration; // Add missing import
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Fetch courses with related units and teachers
        $courses = Course::with('units.teacher')->get();

        // Get enrolled course IDs
        $enrolledCourses = Enrollment::where('student_id', $user->id)->pluck('course_id');

        // Fetch student results with related units and courses
        $results = Result::where('student_id', $user->id)
                        ->with('unit.course')
                        ->get();

        // Get registered unit IDs for the student
        $registeredUnits = UnitRegistration::where('student_id', $user->id)
                            ->pluck('unit_id');

        return view('student.dashboard', compact('courses', 'enrolledCourses', 'results', 'registeredUnits'));
    }
}
