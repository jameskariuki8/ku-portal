@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h2 class="font-weight-bold text-dark">📚 Manage Units & Courses</h2>
       
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center font-weight-bold shadow-sm" role="alert">
            ✅ <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

   
<!-- Add Unit Modal -->
<div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg border-0">
            
            <!-- Modal Header -->
            <div class="modal-header bg-gradient-primary text-green">
                <h5 class="modal-title fw-bold" id="addUnitModalLabel">📖 Add a New Unit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body bg-light px-4 py-3">
                <form method="POST" action="{{ route('teacher.units.store') }}">
                    @csrf

                    <!-- Unit Name Input -->
                    <div class="form-group">
                        <label for="unit_name" class="fw-bold text-dark">Unit Name</label>
                        <input type="text" name="unit_name" class="form-control rounded-pill shadow-sm border-0 px-3 py-2" 
                               placeholder="Enter unit name" required>
                    </div>

                    <!-- Unit Code Input -->
                    <div class="form-group mt-3">
                        <label for="unit_code" class="fw-bold text-dark">Unit Code</label>
                        <input type="text" name="unit_code" class="form-control rounded-pill shadow-sm border-0 px-3 py-2" 
                               placeholder="Enter unit code" required>
                    </div>

                    <!-- Course Selection -->
                    <div class="form-group mt-3">
                        <label for="course_id" class="fw-bold text-dark">Select Course</label>
                        <select name="course_id" class="form-control rounded-pill shadow-sm border-0 px-3 py-2" required>
                            <option value="" disabled selected>-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 mt-4 py-3 rounded-pill fw-bold shadow-sm">
                        ✅ Add Unit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
