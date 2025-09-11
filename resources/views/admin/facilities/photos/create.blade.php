@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Add Photo for {{ $category->name }}</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-4 mb-6 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.facilities.categories.photos.store', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800">Upload Photo</button>
    </form>
</div>
@endsection
