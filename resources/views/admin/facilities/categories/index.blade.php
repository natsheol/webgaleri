{{-- resources/views/admin/facilities/index.blade.php --}}
@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-white text-gray-800 px-6 py-10">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Facilities Management
        </h1>
        <p class="text-gray-500 mt-2">Manage facility categories and photos in the Hogwarts network</p>
    </div>

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-10">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-800 transition">Dashboard</a> /
        <span class="text-gray-400">Facilities</span>
    </nav>

    {{-- ========== CATEGORY SECTION ========== --}}
    <section class="mb-16 px-6 lg:px-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#b03535] via-[#3c5e5e] to-[#425d9e] rounded-full"></span>
                Facility Categories
            </h2>
            <a href="{{ route('admin.facilities.categories.create') }}" 
               class="px-5 py-2.5 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-xl shadow hover:opacity-90 transition">
                + Add Category
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-md border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Category Name</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-gray-500">{{ $category->id }}</td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $category->name }}</td>
                            <td class="py-3 px-4 text-center">
                                <form action="{{ route('admin.facilities.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus kategori ini?')">
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
                            <td colspan="3" class="py-4 text-center text-gray-500">No categories available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- ========== FACILITIES GALLERY SECTION ========== --}}
    <section class="px-6 lg:px-10">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
            Facilities Gallery
        </h2>

        @foreach($categories as $category)
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                    <a href="{{ route('admin.facilities.categories.photos.create', $category->id) }}" 
                       class="px-4 py-2 bg-gradient-to-r from-[#3c5e5e] to-[#425d9e] text-white rounded-lg shadow hover:opacity-90 transition text-sm">
                        + Add Photo
                    </a>
                </div>

                @if($category->photos->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($category->photos as $photo)
                            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition">
                                <div class="relative">
                                    <img src="{{ $photo->image ? asset('storage/'.$photo->image) : 'https://via.placeholder.com/400x300' }}" 
                                         alt="{{ $photo->name ?? 'Untitled' }}"
                                         class="h-40 w-full object-cover">

                                    {{-- View Count Badge --}}
                                    <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded-full text-xs flex items-center">
                                        👁️ <span class="ml-1">{{ $photo->view_count ?? 0 }}</span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <div class="text-sm font-semibold text-gray-800 mb-1">
                                        {{ $photo->name ?? 'Untitled' }}
                                    </div>

                                    <div class="text-xs text-gray-600 mb-3 flex items-center gap-1">
                                        👁️ <span class="font-medium">{{ $photo->view_count ?? 0 }}</span> views
                                    </div>

                                    <div class="flex justify-between">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.facilities.categories.photos.edit', [$category->id, $photo->id]) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 text-xs rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.facilities.categories.photos.destroy', [$category->id, $photo->id]) }}" method="POST"
                                              onsubmit="return confirm('Yakin mau hapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 text-white px-3 py-1 text-xs rounded-md hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 mt-2">No photos in this category.</p>
                @endif
            </div>
        @endforeach
    </section>
</div>
@endsection
