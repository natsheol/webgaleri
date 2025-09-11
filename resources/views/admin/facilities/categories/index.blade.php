@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Facilities Categories</h1>

    <a href="{{ route('admin.facilities.categories.create') }}" 
    class="mb-4 inline-block px-4 py-2 bg-amber-600 text-white rounded-lg">+ Add Category</a>

    <table class="w-full border-collapse border mb-8">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nama Kategori</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="border px-4 py-2">{{ $category->id }}</td>
                <td class="border px-4 py-2">{{ $category->name }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('admin.facilities.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-2xl font-bold mb-4">Facilities Gallery</h2>

    @foreach($categories as $category)
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>

            <div class="grid grid-cols-4 gap-4 mb-2">
                @foreach($category->photos as $photo)
                    <div class="border p-2 rounded-lg">
                        <img src="{{ asset('storage/'.$photo->image) }}" class="h-32 w-full object-cover rounded mb-2">
                        <div class="text-sm font-medium">{{ $photo->name }}</div>
                    </div>
                @endforeach

                <div class="flex items-center justify-center border rounded-lg">
                    <a href="{{ route('admin.facilities.categories.photos.create', $category->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center">+ Add Photo</a>
                </div>
            </div> 
        </div>
    @endforeach
</div>
@endsection
