@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Students Management</h1>
        <a href="{{ route('admin.students.create') }}"
           class="px-4 py-2 bg-amber-700 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center hover:bg-amber-900">
           Add New Student
        </a>
    </div>

    <!-- Filters & Total -->
    <div class="flex gap-6 items-center mb-4">
        <form method="GET" action="{{ route('admin.students.index') }}" class="flex gap-2">
            <!-- House filter -->
            <select name="house_id" class="border rounded-lg p-2">
                <option value="">All Houses</option>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}" {{ request('house_id') == $house->id ? 'selected' : '' }}>
                        {{ $house->name }}
                    </option>
                @endforeach
            </select>

            <!-- Status filter -->
            <select name="status" class="border rounded-lg p-2">
                <option value="">All Students</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="alumni" {{ request('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
                Filter
            </button>
        </form>

        <div class="text-gray-700 ml-6">
            <p><strong>Total Students:</strong> {{ $totalStudents }}</p>
        </div>
    </div>

    <!-- Students Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Photo</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Birth Date</th>
                    <th class="py-2 px-4 border">Year</th>
                    <th class="py-2 px-4 border">House</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="py-2 px-4 border text-center">{{ 'STU-' . str_pad($student->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-2 px-4 border flex items-center justify-center">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="w-8 h-10 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400">No photo</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border">{{ $student->name }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->birth_date ?? '-' }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->year ?? '-' }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->house?->name ?? '-' }}</td>
                        <td class="py-2 px-4 border flex gap-2 items-center justify-center">
                            <a href="{{ route('admin.students.edit', $student->id) }}"
                               class="text-yellow-500 hover:text-yellow-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18" />
                                    <path d="M7 17v-4l10 -10l4 4l-10 10h-4" />
                                    <path d="M14 6l4 4" />
                                    <path d="M14 6l4 4L21 7L17 3Z" fill="currentColor" fill-opacity="0.3" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 20h5c0.5 0 1 -0.5 1 -1v-14M12 20h-5c-0.5 0 -1 -0.5 -1 -1v-14" />
                                        <path d="M4 5h16" />
                                        <path d="M10 4h4M10 9v7M14 9v7" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
