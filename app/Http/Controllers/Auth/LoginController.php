<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;


use Illuminate\Support\Facades\Auth;

Route::get('/redirect', function () {
    if (Auth::check()) {
        $role = Auth::user()->role; // Assuming 'role' is stored in users table
        if ($role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect('/login');
})->name('redirect');

// Default route (redirects students to their dashboard)
Route::get('/', function () {
    return redirect()->route('student.dashboard');
});

// Student Dashboard with Units
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', function () {
        $units = \App\Models\Unit::all();
        return view('student.dashboard', compact('units'));
    })->name('student.dashboard');
});


// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/units/create', [UnitController::class, 'create'])->name('teacher.units.create');
    Route::post('/teacher/units/store', [UnitController::class, 'store'])->name('teacher.units.store');
    Route::get('/teacher/units', [UnitController::class, 'index'])->name('units.index');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/teachers', [AdminController::class, 'viewTeachers'])->name('admin.teachers');
    Route::get('/admin/units', [AdminController::class, 'viewUnits'])->name('admin.units');
    Route::get('/admin/add-teacher', [AdminController::class, 'showTeacherForm'])->name('admin.add-teacher');
    Route::post('/admin/add-teacher', [AdminController::class, 'storeTeacher']);
});

// Student Registration
Route::get('/register/student', [RegisterController::class, 'showStudentRegistrationForm'])->name('register.student');
Route::post('/register/student', [RegisterController::class, 'registerStudent']);

// Teacher Registration (Only Admin Can Register Teachers)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/register/teacher', [RegisterController::class, 'showTeacherRegistrationForm'])->name('register.teacher');
    Route::post('/register/teacher', [RegisterController::class, 'registerTeacher']);
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
Route::middleware(['redirect.authenticated'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

require __DIR__.'/auth.php';

