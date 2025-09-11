@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Professors Management</h1>
        <a href="{{ route('admin.professors.create') }}"
           class="px-4 py-2 bg-amber-700 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center hover:bg-amber-900">Add New Professor</a>
    </div>

    <form method="GET" action="{{ route('admin.professors.index') }}" class="mb-4 flex gap-2">
        <select name="house_id" class="border rounded-lg p-2">
            <option value="">All Houses</option>
            @foreach($houses as $house)
                <option value="{{ $house->id }}" {{ request('house_id') == $house->id ? 'selected' : '' }}>
                    {{ $house->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center hover:bg-gray-700">Filter</button>
    </form>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Name</th>
                <th class="py-2 px-4 border">Position</th>
                <th class="py-2 px-4 border">Subject</th>
                <th class="py-2 px-4 border">House</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($professors as $prof)
                <tr>
                    <td class="py-2 px-4 border">{{ $prof->id }}</td>
                    <td class="py-2 px-4 border">{{ $prof->name }}</td>
                    <td class="py-2 px-4 border">{{ $prof->position ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $prof->subject ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $prof->house?->name ?? '-' }}</td>
                    <td class="py-2 border px-4 flex gap-2 items-center justify-center">
                        <a href="{{ route('admin.professors.edit', $prof->id) }}"
                           class="text-yellow-500 hover:text-yellow-600 flex items-center justify-center align-middle">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18" />
                                <path d="M7 17v-4l10 -10l4 4l-10 10h-4" />
                                <path d="M14 6l4 4" />
                                <path d="M14 6l4 4L21 7L17 3Z" fill="currentColor" fill-opacity="0.3" />
                            </svg>
                        </a>

                        <form action="{{ route('admin.professors.destroy', $prof->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this professor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 hover:text-red-600 flex items-center justify-center align-middle">
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
                    <td colspan="6" class="text-center py-4">No professors found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
