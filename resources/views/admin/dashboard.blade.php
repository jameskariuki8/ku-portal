@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #eef1f6; min-height: 100vh;">
    <h2 class="text-center mb-5 text-dark fw-bold">Admin Dashboard</h2>

    <div class="row g-4 justify-content-center">
        <!-- Total Teachers -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #007bff; color: white;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Total Teachers</h5>
                    <p class="card-text display-5 fw-bold">{{ $teachersCount }}</p>
                    <a href="{{ route('admin.teachers') }}" class="btn btn-outline-light w-100 mt-3 fw-bold">View Teachers</a>
                </div>
            </div>
        </div>

        <!-- Total Units -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #28a745; color: white;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Total Units</h5>
                    <p class="card-text display-5 fw-bold">{{ $unitsCount }}</p>
                    <a href="{{ route('admin.units') }}" class="btn btn-outline-light w-100 mt-3 fw-bold">View Units</a>
                </div>
            </div>
        </div>

        <!-- Add Teacher -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #ffc107; color: black;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Manage Teachers</h5>
                    <a href="{{ route('admin.add-teacher') }}" class="btn btn-dark w-100 mt-3 fw-bold">Add Teacher</a>
                </div>
            </div>
        </div>

        <!-- Add Course -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #dc3545; color: white;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Manage Courses</h5>
                    <a href="{{ route('admin.add-course') }}" class="btn btn-light w-100 mt-3 fw-bold">Add Course</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
