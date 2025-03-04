<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitRegistration;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class UnitRegistrationController extends Controller
{
    public function register(Unit $unit)
    {
        $studentId = Auth::id();

        // Ensure student is enrolled in the course first
        if (!Auth::user()->enrollments()->where('course_id', $unit->course_id)->exists()) {
            return back()->with('error', 'You must be enrolled in the course first.');
        }

        // Prevent duplicate registration
        if (UnitRegistration::where('student_id', $studentId)->where('unit_id', $unit->id)->exists()) {
            return back()->with('error', 'You are already registered for this unit.');
        }

        // Register unit
        UnitRegistration::create([
            'student_id' => $studentId,
            'unit_id' => $unit->id
        ]);

        return back()->with('success', 'Successfully registered for ' . $unit->name);
    }
}
