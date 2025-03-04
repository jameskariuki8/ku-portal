@extends('layouts.app')

@section('content')
    <h1>Add a New Course</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <label for="name">Course Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter Course Name" required>
        <button type="submit">Add Course</button>
    </form>
@endsection
