@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f4f6f9; min-height: 100vh;">
    <h2 class="text-center mb-5 text-dark fw-bold">Admin Dashboard</h2>

    <div class="row g-4 justify-content-center">
        <!-- Total Teachers Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #007bff; color: white;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">Total Teachers</h5>
                    <p class="card-text display-5 fw-bold">{{ $teachersCount }}</p>
                    <a href="{{ route('admin.teachers') }}" class="btn btn-light w-100 mt-3">View Teachers</a>
                </div>
            </div>
        </div>

        <!-- Total Units Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #28a745; color: white;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">Total Units</h5>
                    <p class="card-text display-5 fw-bold">{{ $unitsCount }}</p>
                    <a href="{{ route('admin.units') }}" class="btn btn-light w-100 mt-3">View Units</a>
                </div>
            </div>
        </div>

        <!-- Add New Teacher Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #ffc107; color: black;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-semibold">Add New Teacher</h5>
                    <a href="{{ route('admin.add-teacher') }}" class="btn btn-dark w-100 mt-3">Add Teacher</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
