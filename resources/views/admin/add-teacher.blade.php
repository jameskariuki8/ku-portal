@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="card shadow-lg rounded-4 p-4" style="max-width: 500px; width: 100%; background-color: #f8f9fa;">
        <h2 class="text-center mb-4 text-primary">Add New Teacher</h2>
        <form action="{{ route('admin.store-teacher') }}" method="POST">
            @csrf
            
            <!-- Teacher Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Teacher Name</label>
                <input type="text" class="form-control border-2 border-primary" id="name" name="name" required 
                       placeholder="Enter teacher's name">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control border-2 border-primary" id="email" name="email" required 
                       placeholder="Enter teacher's email">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control border-2 border-primary" id="password" name="password" required 
                       placeholder="Enter a secure password">
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                <input type="password" class="form-control border-2 border-primary" id="password_confirmation" 
                       name="password_confirmation" required placeholder="Re-enter password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                <i class="fas fa-user-plus"></i> Add Teacher
            </button>
        </form>
    </div>
</div>
@endsection
