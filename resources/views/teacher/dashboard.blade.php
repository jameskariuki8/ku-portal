@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg dark:bg-gray-800">
    
    <!-- Dashboard Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Teacher Dashboard</h2>
        <a href="{{ route('teacher.units.create') }}" 
           class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            + Add New Unit
        </a>
    </div>

    <!-- Units Section -->
    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Your Units</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white dark:bg-gray-900 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Unit Name</th>
                        <th class="py-3 px-6 text-left">Course</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 dark:text-gray-300 text-sm">
                    @foreach($units as $unit)
                        <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="py-3 px-6">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 font-medium">{{ $unit->name }}</td>
                            <td class="py-3 px-6">{{ $unit->course->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Courses and Enrollments Section -->
    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Your Courses & Enrolled Students</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white dark:bg-gray-900 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Course</th>
                        <th class="py-3 px-6 text-left">Student</th>
                        <th class="py-3 px-6 text-left">Registered Units</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 dark:text-gray-300 text-sm">
                    @forelse($courses as $course)
                        @forelse($course->enrollments as $enrollment)
                            <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="py-3 px-6">{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $course->name }}</td>
                                <td class="py-3 px-6">{{ $enrollment->student->name }}</td>
                                <td class="py-3 px-6">
                                    <ul class="list-disc pl-4">
                                        @forelse($enrollment->student->registeredUnits as $unit)
                                            <li>{{ $unit->name }} ({{ $unit->code }})</li>
                                        @empty
                                            <span class="text-red-500">No registered units</span>
                                        @endforelse
                                    </ul>
                                </td>
                                <td class="py-3 px-6">
                                    <a href="{{ route('teacher.input.marks', ['student' => $enrollment->student->id]) }}" 
                                       class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                                        Input Marks
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-6 text-center text-gray-500">No students enrolled</td>
                            </tr>
                        @endforelse
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">No courses assigned</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
