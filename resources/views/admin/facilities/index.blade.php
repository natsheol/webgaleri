@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-white text-gray-800 px-6 py-10">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Facilities Management
        </h1>
        <p class="text-gray-500 mt-2">Manage, edit, and organize all school facilities here</p>
    </div>

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-10">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-800 transition">Dashboard</a> /
        <span class="text-gray-400">Facilities</span>
    </nav>

    {{-- Add Button --}}
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.facilities.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-xl font-medium shadow hover:opacity-90 transition">
            <i class="fas fa-plus"></i> Add New Facility
        </a>
    </div>

    {{-- Facilities Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-md border border-gray-200 px-4 sm:px-6 lg:px-10 py-6">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">Facility Name</th>
                    <th class="py-3 px-4">Category</th>
                    <th class="py-3 px-4">Image</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($facilities as $facility)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-500">{{ $facility->id }}</td>
                        <td class="py-3 px-4 font-medium text-gray-800">{{ $facility->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $facility->category->name ?? 'Uncategorized' }}</td>
                        <td class="py-3 px-4">
                            @if($facility->image)
                                <img src="{{ asset('storage/'.$facility->image) }}" alt="{{ $facility->name }}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                            @else
                                <div class="h-16 w-16 flex items-center justify-center bg-gray-100 text-gray-400 text-xs rounded-lg border border-gray-200">
                                    No Image
                                </div>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.facilities.edit', $facility->id) }}" 
                                   class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this facility?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No facilities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $facilities->links() }}
    </div>
</div>
@endsection
