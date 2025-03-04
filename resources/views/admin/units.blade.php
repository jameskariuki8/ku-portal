@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">📚 Units Added by Teachers</h2>

    @if($units->isEmpty())
        <div class="alert alert-warning text-center">
            No units have been added yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center shadow-sm">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Unit Name</th>
                        <th>Course</th>
                        <th>Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td class="border border-primary">{{ $loop->iteration }}</td>
                            <td class="border border-success font-weight-bold">{{ $unit->unit_name }}</td>
                            <td class="border border-info">{{ $unit->course->course_name ?? 'N/A' }}</td>
                            <td class="border border-danger">{{ $unit->teacher->name ?? 'Unknown' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
