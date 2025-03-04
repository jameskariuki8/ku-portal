@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add a New Unit</h2>
    <form action="{{ route('teacher.units.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Unit Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Unit Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Unit</button>
    </form>
</div>
@endsection
