<?php
use App\Http\Controllers\UnitRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;



Route::get('/units', [UnitController::class, 'index'])->name('units.index');

Route::get('/dashboard', function () {
    return redirect()->route('redirect');
})->name('dashboard');

// Redirect users based on their role after login
Route::get('/redirect', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $role = Auth::user()->role;
    return match ($role) {
        'teacher' => redirect()->route('teacher.dashboard'),
        'admin' => redirect()->route('admin.dashboard'),
        default => redirect()->route('student.dashboard'),
    };
})->name('redirect');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// Redirect the home route to login or respective dashboard
Route::get('/', function () {
    return Auth::check() ? redirect()->route('redirect') : redirect('/login');
})->name('home');


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/enroll-course', [CourseController::class, 'enroll'])->name('course.enroll');
    Route::post('/enroll/{course}', [EnrollmentController::class, 'enroll'])->name('enrollment.enroll')->middleware('auth');
    Route::post('/register-unit/{unit}', [UnitRegistrationController::class, 'register'])->name('register.unit')->middleware('auth');

});


// Teacher Dashboard
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/units/create', [UnitController::class, 'create'])->name('teacher.units.create');
    Route::post('/teacher/units/store', [UnitController::class, 'store'])->name('teacher.units.store');
    Route::get('/teacher/units', [UnitController::class, 'index'])->name('teacher.units.index');
    Route::get('/teacher/input-marks/{student}', [TeacherController::class, 'inputMarks'])
    ->name('teacher.input.marks');
    Route::post('/teacher/store-marks/{student}', [TeacherController::class, 'storeMarks'])
    ->name('teacher.store.marks');

});

// Admin Dashboard Routes (Only Accessible to Admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/teachers', [AdminController::class, 'viewTeachers'])->name('admin.teachers');
    Route::get('/admin/units', [AdminController::class, 'viewUnits'])->name('admin.units');
    Route::get('/admin/add-teacher', [AdminController::class, 'showTeacherForm'])->name('admin.add-teacher');
    Route::post('/admin/add-teacher', [AdminController::class, 'storeTeacher'])->name('admin.store-teacher');
    Route::get('/admin/add-course', [CourseController::class, 'showAddCourseForm'])->name('admin.add-course');
    Route::post('/admin/courses/store', [CourseController::class, 'store'])->name('courses.store');
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
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

require __DIR__.'/auth.php';
