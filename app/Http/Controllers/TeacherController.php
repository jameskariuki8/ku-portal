<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;


class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();

        // Fetch all units taught by the teacher
        $units = Unit::where('teacher_id', $teacher->id)->get();

        // Fetch courses where the teacher teaches at least one unit
        $courses = Course::whereHas('units', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->with([
            'enrollments.student.registeredUnits' // Include students and their registered units
        ])->get();

        return view('teacher.dashboard', compact('units', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:units,code',
            'course_id' => 'required|exists:courses,id',
        ]);

        Unit::create([
            'name' => $request->name,
            'code' => $request->code,
            'course_id' => $request->course_id,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Unit added successfully!');
    }
    
    public function storeMarks(Request $request, $studentId)
    {
        $request->validate([
            'marks' => 'required|array',
            'marks.*' => 'numeric|min:0|max:100',
            'grades' => 'required|array',
            'grades.*' => 'string|max:2'
        ]);
    
        $student = User::where('role', 'student')->findOrFail($studentId);
    
        foreach ($request->marks as $unitId => $mark) {
            $grade = $request->grades[$unitId];
    
            // Use the correct relationship method
            $student->registeredUnits()->updateExistingPivot($unitId, [
                'marks' => $mark,
                'grade' => $grade
            ]);
        }
    
        return redirect()->route('teacher.dashboard')->with('success', 'Marks updated successfully.');
    }

    public function inputMarks($studentId)
{
    $teacher = Auth::user();

    // Fetch the student
    $student = User::where('role', 'student')->findOrFail($studentId);

    // Get units the teacher teaches
    $units = Unit::where('teacher_id', $teacher->id)->get();

    return view('teacher.input-marks', compact('student', 'units'));
}

    

}
