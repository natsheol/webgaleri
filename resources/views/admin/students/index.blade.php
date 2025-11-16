@extends('layouts.manage')

@section('title', 'Students Management')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Students Management
        </h1>
        <a href="{{ route('admin.students.create') }}"
           class="mt-4 md:mt-0 inline-block px-5 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white font-semibold rounded-2xl shadow hover:opacity-90 transition">
           Add New Student
        </a>
    </div>

    <!-- Filters & Total -->
    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center mb-8">
        <form method="GET" action="{{ route('admin.students.index') }}" class="flex flex-wrap gap-3 items-center">
            <!-- House filter -->
            <select name="house_id" class="border border-gray-300 rounded-xl p-2 focus:ring-2 focus:ring-[#425d9e] focus:outline-none">
                <option value="">All Houses</option>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}" {{ request('house_id') == $house->id ? 'selected' : '' }}>
                        {{ $house->name }}
                    </option>
                @endforeach
            </select>

            <!-- Status filter -->
            <select name="status" class="border border-gray-300 rounded-xl p-2 focus:ring-2 focus:ring-[#425d9e] focus:outline-none">
                <option value="">All Students</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="alumni" {{ request('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-[#425d9e] text-white rounded-xl shadow hover:opacity-90 transition">
                Filter
            </button>
        </form>

        <div class="text-gray-700 ml-auto mt-2 md:mt-0">
            <p class="font-medium">Total Students: <span class="font-bold">{{ $totalStudents }}</span></p>
        </div>
    </div>

    <!-- Students Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-2xl shadow-sm overflow-hidden text-sm text-gray-700">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-4 border text-center">ID</th>
                    <th class="py-3 px-4 border text-center">Photo</th>
                    <th class="py-3 px-4 border text-center">Name</th>
                    <th class="py-3 px-4 border text-center">Birth Date</th>
                    <th class="py-3 px-4 border text-center">Year</th>
                    <th class="py-3 px-4 border text-center">House</th>
                    <th class="py-3 px-4 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2 px-4 border text-center font-mono">
                            @php
                                $prefix = ($student->year < now()->year - 6) ? 'ALU-' : 'STU-';
                            @endphp
                            {{ $prefix . $student->id }}
                        </td>

                        <td class="py-2 px-4 border text-center">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="w-10 h-12 object-cover rounded-xl mx-auto border border-gray-200 shadow-sm">
                            @else
                                <div class="w-10 h-12 flex items-center justify-center bg-gray-100 rounded-xl border border-gray-200 text-gray-400 text-xs">
                                    No Photo
                                </div>
                            @endif
                        </td>

                        <td class="py-2 px-4 border text-center font-semibold">{{ $student->name }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->birth_date ?? '-' }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->year ?? '-' }}</td>
                        <td class="py-2 px-4 border text-center">{{ $student->house?->name ?? '-' }}</td>

                        <td class="py-2 px-4 border text-center flex gap-2 justify-center">
                            <a href="{{ route('admin.students.edit', $student->id) }}" 
                               class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-xl hover:bg-yellow-200 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
