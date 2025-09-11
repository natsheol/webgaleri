@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Photos in {{ $category->name }}</h1>
        <a href="{{ route('admin.facilities.categories.index') }}" 
           class="px-3 py-1 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 text-sm">
           Back
        </a>
    </div>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.facilities.categories.photos.store', $category) }}" 
          method="POST" enctype="multipart/form-data" class="mb-6 space-y-2">
        @csrf
        <input type="text" name="name" placeholder="Photo name" class="border p-2 w-full" required>
        <textarea name="description" placeholder="Description" class="border p-2 w-full"></textarea>
        <input type="file" name="image" class="border p-2 w-full" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload Photo</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($photos as $photo)
            <div class="border p-2 rounded">
                <img src="{{ asset('storage/'.$photo->image) }}" 
                     alt="{{ $photo->name }}" class="mb-2 w-full h-32 object-cover rounded">
                <p class="font-semibold">{{ $photo->name }}</p>
                <p class="text-sm text-gray-500">{{ $photo->description }}</p>
                <form action="{{ route('admin.facilities.categories.photos.destroy', [$category, $photo]) }}" 
                      method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
