@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold">User Profile</h2>
    
    <div class="mt-4 bg-white p-4 rounded shadow">
        <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</p>

        <a href="{{ route('profile.edit') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">Edit Profile</a>
    </div>
</div>
@endsection
