@extends('layouts.app')

@section('content')
<div class="container-fluid py-5" style="background-color: #eef1f6; min-height: 100vh;">
    <h2 class="text-center fw-bold text-dark">Admin Dashboard</h2>
    <p class="text-center text-muted">
        Manage teachers, units, and courses efficiently from one place.
    </p>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="row">
                <!-- Total Teachers -->
                <div class="col-md-4">
                    <div class="shadow-sm p-4 rounded bg-white text-center">
                        <h4 class="fw-bold text-primary">Total Teachers</h4>
                        <h2 class="fw-bold">{{ $teachersCount }}</h2>
                        <a href="{{ route('admin.teachers') }}" class="text-primary fw-semibold mt-2 d-block">
                            View Teachers
                        </a>
                    </div>
                </div>

                <!-- Total Units -->
                <div class="col-md-4">
                    <div class="shadow-sm p-4 rounded bg-white text-center">
                        <h4 class="fw-bold text-success">Total Units</h4>
                        <h2 class="fw-bold">{{ $unitsCount }}</h2>
                        <a href="{{ route('admin.units') }}" class="text-success fw-semibold mt-2 d-block">
                            View Units
                        </a>
                    </div>
                </div>

                <!-- Manage Teachers -->
                <div class="col-md-4">
                    <div class="shadow-sm p-4 rounded bg-white text-center">
                        <h4 class="fw-bold text-warning">Manage Teachers</h4>
                        <a href="{{ route('admin.add-teacher') }}" class="text-warning fw-semibold mt-2 d-block">
                            Add Teacher
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Manage Courses -->
                <div class="col-md-4 offset-md-2">
                    <div class="shadow-sm p-4 rounded bg-white text-center">
                        <h4 class="fw-bold text-danger">Manage Courses</h4>
                        <a href="{{ route('admin.add-course') }}" class="text-danger fw-semibold mt-2 d-block">
                            Add Course
                        </a>
                    </div>
                </div>

                <!-- Placeholder (if needed for symmetry) -->
                <div class="col-md-4">
                    <div class="shadow-sm p-4 rounded bg-white text-center">
                        <h4 class="fw-bold text-info">Reports & Analysis</h4>
                        <a href="#" class="text-info fw-semibold mt-2 d-block">
                            View Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
