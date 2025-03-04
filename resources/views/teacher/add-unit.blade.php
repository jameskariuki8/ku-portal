@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-header bg-primary text-white text-center font-weight-bold">
                    {{ __('Add Unit to Course') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('units.store') }}">
                        @csrf

                        <!-- Unit Name -->
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">{{ __('Unit Name') }}</label>
                            <input type="text" name="name" class="form-control rounded-lg" placeholder="Enter unit name" required>
                        </div>

                        <!-- Select Course -->
                        <div class="form-group mt-3">
                            <label for="course_id" class="font-weight-bold">{{ __('Select Course') }}</label>
                            <select name="course_id" class="form-control rounded-lg" required>
                                <option value="" disabled selected>-- Select Course --</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mt-4 shadow-sm">
                            <i class="fas fa-plus-circle"></i> Add Unit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
