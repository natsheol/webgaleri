{{-- resources/views/admin/facilities/photos/index.blade.php --}}
@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Photos in {{ $category->name }}</h1>
        <a href="{{ route('admin.facilities.categories.photos.create', $category->id) }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
           + Add Photo
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    @if($photos->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($photos as $photo)
                <div class="border rounded shadow-sm overflow-hidden relative">
                    <div class="relative">
                        <img src="{{ $photo->image ? asset('storage/'.$photo->image) : 'https://via.placeholder.com/400x300' }}" 
                             alt="{{ $photo->name }}" class="w-full h-48 object-cover">
                        
                        {{-- View Count Badge --}}
                        <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded-full text-xs flex items-center">
                            <span class="mr-1">👁️</span>
                            <span>{{ $photo->view_count ?? 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $photo->name }}</h3>
                        
                        {{-- View Count Display --}}
                        <div class="mb-3 flex items-center text-sm text-gray-600">
                            <span class="mr-1">👁️</span>
                            <span class="font-medium">{{ $photo->view_count ?? 0 }}</span>
                            <span class="ml-1">views</span>
                        </div>
                        
                        <div class="flex justify-between space-x-2">
                            <a href="{{ route('admin.facilities.categories.photos.edit', [$category->id, $photo->id]) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-sm">Edit</a>
                            <form action="{{ route('admin.facilities.categories.photos.destroy', [$category->id, $photo->id]) }}" 
                                  method="POST" onsubmit="return confirm('Are you sure want to delete?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No photos in this category yet.</p>
    @endif
</div>
@endsection
