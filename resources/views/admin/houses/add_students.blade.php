@extends('layouts.manage')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Houses</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add New House Button -->
    <a href="{{ route('admin.houses.create') }}"
       class="mb-4 inline-block px-4 py-2 bg-amber-700 text-white rounded shadow hover:bg-amber-900">
        Add New House
    </a>

    <!-- Houses Table -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Logo</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Slug</th>
                <th class="border px-4 py-2">Characteristics</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($houses as $house)
            <tr class="text-center">
                <!-- Logo -->
                <td class="border px-4 py-2">
                    @if($house->logo)
                        <img src="{{ asset('storage/'.$house->logo) }}" 
                             alt="{{ $house->name }}" 
                             class="w-16 h-16 object-cover mx-auto rounded">
                    @else
                        -
                    @endif
                </td>

                <!-- Name -->
                <td class="border px-4 py-2">{{ $house->name }}</td>

                <!-- Slug -->
                <td class="border px-4 py-2">{{ $house->slug }}</td>

                <!-- Characteristics -->
                <td class="border px-4 py-2">
                    {{ is_array($house->characteristics) ? implode(', ', $house->characteristics) : '-' }}
                </td>

                <!-- Actions -->
                <td class="border px-4 py-2 flex justify-center gap-2">
                    <a href="{{ route('admin.houses.edit', $house->id) }}"
                       class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                    <a href="{{ route('admin.houses.addStudents', $house->id) }}"
                       class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700">Update Students</a>
                    <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <!-- Optional: View button for guest page -->
                    <!--
                    <a href="{{ route('houses.show', $house->slug) }}"
                       class="px-2 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">View</a>
                    -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
