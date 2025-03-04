@extends('layouts.app')

@section('content')
<div class="container">
    <h2> Student : {{ $student->name }}</h2>
    <p><strong>Course(s):</strong> 
    {{ $student->courses->pluck('name')->implode(', ') ?: 'No Course Assigned' }}
</p>



    <form action="{{ route('teacher.store.marks', $student->id) }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unit Name</th>
                    <th>Marks (0-100)</th>
                    <th>Grade (A-F)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($student->registeredUnits as $unit)

                <tr>
                    <td>{{ $unit->name }}</td>
                    <td>
                        <input type="number" name="marks[{{ $unit->id }}]" min="0" max="100" class="form-control" required>
                    </td>
                    <td>
                        <select name="grades[{{ $unit->id }}]" class="form-control" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit Marks</button>
    </form>
</div>
@endsection
