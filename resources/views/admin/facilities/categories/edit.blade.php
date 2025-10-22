<!-- @extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Photo: {{ $photo->name }}</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-4 mb-6 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.facilities.categories.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $photo->name) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
            <textarea name="description" class="w-full border rounded p-2">{{ old('description', $photo->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Photo</label>
            <img src="{{ asset('storage/'.$photo->image) }}" class="h-40 object-cover mb-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Replace Photo (optional)</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_cover" id="is_cover" {{ $photo->category->cover_photo_id === $photo->id ? 'checked' : '' }}>
            <label for="is_cover" class="text-sm">Set as cover photo</label>
        </div>

        <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800">Update Photo</button>
    </form>

    <form action="{{ route('admin.facilities.categories.photos.destroy', $photo->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin mau hapus photo ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete Photo</button>
    </form>
</div>
@endsection -->
