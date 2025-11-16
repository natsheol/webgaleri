@extends('layouts.manage')

@section('title', 'Professors')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Edit ' , 'route' => route('admin.houses.index')],
        ['label' => 'Professors', 'route' => null],
    ];
@endphp

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
        Professors Management
    </h1>
    <p class="text-gray-500 mt-2">Manage professors and assign them to houses and subjects</p>
</div>

<div class="flex justify-end mb-6 px-6 lg:px-10">
    <a href="{{ route('admin.professors.create') }}"
       class="px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-xl shadow hover:opacity-90 transition">
       + Add Professor
    </a>
</div>

<div class="px-6 lg:px-10">
    <div class="overflow-hidden rounded-2xl bg-white shadow-md border border-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Position</th>
                    <th class="py-3 px-4">Subject</th>
                    <th class="py-3 px-4">House</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professors as $prof)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-500">{{ $prof->id }}</td>
                        <td class="py-3 px-4 font-medium text-gray-800">{{ $prof->name }}</td>
                        <td class="py-3 px-4">{{ $prof->position ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $prof->subject ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $prof->house?->name ?? '-' }}</td>
                        <td class="py-3 px-4 text-right flex justify-end gap-2">
                            <a href="{{ route('admin.professors.edit', $prof->id) }}"
                               class="px-3 py-1.5 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition">
                               <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.professors.destroy', $prof->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this professor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">No professors available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-end px-4 pb-4">
            {{ $professors->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
