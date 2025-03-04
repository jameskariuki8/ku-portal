@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Student Dashboard</h2>

    {{-- Courses Section --}}
    <div class="bg-gray-100 p-4 rounded-lg shadow mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-3">Available Courses</h3>
        
        @if ($courses->isEmpty())
            <p class="text-gray-600">No courses available at the moment.</p>
        @else
            <ul class="space-y-2">
                @foreach ($courses as $course)
                    <li class="bg-white p-3 rounded-md shadow-md">
                        <div class="flex justify-between items-center">
                            <button class="text-left font-medium text-lg text-blue-600" onclick="toggleUnits({{ $course->id }})">
                                {{ $course->name }}
                            </button>
                            
                            @if($enrolledCourses->contains($course->id))
                                <span class="bg-green-500 text-white px-3 py-1 rounded">Enrolled</span>
                            @else
                                <form method="POST" action="{{ route('enrollment.enroll', $course->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Enroll</button>
                                </form>
                            @endif
                        </div>
                        
                        @if($enrolledCourses->contains($course->id))
                            <ul id="units-{{ $course->id }}" class="hidden mt-2 space-y-1">
                                @foreach ($course->units as $unit)
                                    <li class="bg-gray-200 p-2 rounded-md flex justify-between items-center">
                                        <div>
                                            <span class="text-gray-700">{{ $unit->name }}</span>
                                            <span class="text-gray-500">({{ $unit->code }})</span>
                                            <p class="text-sm text-gray-600">Taught by <span class="font-semibold">{{ $unit->teacher->name ?? 'Unknown' }}</span></p>
                                        </div>

                                        @if($registeredUnits->contains($unit->id))
                                            <span class="bg-green-500 text-white px-3 py-1 rounded">Registered</span>
                                        @else
                                            <form method="POST" action="{{ route('register.unit', $unit->id) }}">
                                                @csrf
                                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Register</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Results Section --}}
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h3 class="text-xl font-semibold text-gray-700 mb-3">Your Results</h3>
        
        @if ($results->isEmpty())
            <p class="text-gray-600">No results available yet.</p>
        @else
            <table class="w-full border-collapse bg-white shadow-md rounded-md">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-3 text-left">Course</th>
                        <th class="p-3 text-left">Unit</th>
                        <th class="p-3 text-left">Score</th>
                        <th class="p-3 text-left">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr class="border-b">
                            <td class="p-3">{{ $result->unit->course->name }}</td>
                            <td class="p-3">{{ $result->unit->name }} ({{ $result->unit->code }})</td>
                            <td class="p-3">{{ $result->score }}</td>
                            <td class="p-3 font-semibold 
                                @if($result->score >= 70) text-green-600
                                @elseif($result->score >= 50) text-yellow-600
                                @else text-red-600
                                @endif">
                                {{ $result->grade }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
    function toggleUnits(courseId) {
        let unitList = document.getElementById(`units-${courseId}`);
        unitList.classList.toggle('hidden');
    }
</script>
@endsection
