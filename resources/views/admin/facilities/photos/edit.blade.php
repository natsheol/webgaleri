@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Photo: {{ $photo->name }}</h1>

    <form action="{{ route('admin.facilities.categories.photos.update', [$category->id, $photo->id]) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Photo Name</label>
            <input type="text" name="name" value="{{ old('name', $photo->name) }}" class="w-full border rounded px-3 py-2">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $photo->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Current Image</label>
            <img src="{{ $photo->image ? asset('storage/'.$photo->image) : 'https://via.placeholder.com/400x300' }}" 
                 alt="{{ $photo->name }}" class="w-full h-48 object-cover rounded mb-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">Change Image (optional)</label>
            <input type="file" name="image" class="w-full">
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Checkbox cover photo --}}
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="set_as_cover" value="1"
                    class="mr-2"
                    {{ $category->cover_photo_id == $photo->id ? 'checked' : '' }}>
                Set as cover photo for this category
            </label>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update Photo</button>
            <a href="{{ route('admin.facilities.categories.photos.index', $category->id) }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</a>
        </div>
    </form>
</div>
@endsection

