@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Student: {{ $student->name }}</h2>

    <p class="text-lg text-gray-600 mb-4">
        <strong>Course:</strong> 
        <span class="text-blue-600 font-semibold">
            {{ $student->courses->pluck('name')->implode(', ') ?: 'No Course Assigned' }}
        </span>
    </p>

    {{-- Form for Inputting Marks --}}
    <div class="bg-gray-100 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Enter Marks for Registered Units</h3>

        <form action="{{ route('teacher.store.marks', $student->id) }}" method="POST" class="space-y-4">
            @csrf
            <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-3 text-left">Unit Name</th>
                        <th class="p-3 text-left">Marks (0-100)</th>
                        <th class="p-3 text-left">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->registeredUnits as $unit)
                        <tr class="border-b bg-gray-50 hover:bg-gray-100 transition">
                            <td class="p-3 font-medium text-gray-800">{{ $unit->name }}</td>
                            <td class="p-3">
                                <input type="number" name="marks[{{ $unit->id }}]" min="0" max="100"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </td>
                            <td class="p-3">
                                <select name="grades[{{ $unit->id }}]"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
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
            
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    Submit Marks
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
