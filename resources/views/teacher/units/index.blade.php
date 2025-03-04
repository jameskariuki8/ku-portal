@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">📚 Units</h2>
        <a href="{{ route('teacher.units.create') }}" class="btn btn-primary fw-bold shadow-sm px-4 py-2 rounded-pill">
            ➕ Add Unit
        </a>
    </div>

    <!-- Units Table -->
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <table class="table table-bordered text-center" style="border-collapse: separate; border-spacing: 0 10px;">
                <thead class="bg-primary text-black">
                    <tr>
                        <th class="py-3 border">📖 Unit Name</th>
                        <th class="py-3 border">🎓 Course</th>
                        <th class="py-3 border">🔢 Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr class="bg-light shadow-sm">
                            <td class="py-3 border text-dark fw-semibold">{{ $unit->name }}</td>
                            <td class="py-3 border text-muted fw-semibold">{{ $unit->course->name ?? 'N/A' }}</td>
                            <td class="py-3 border text-dark fw-semibold">{{ $unit->code }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
