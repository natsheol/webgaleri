{{--
@extends('layouts.manage')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Kategori Fasilitas</h1>

    <form action="{{ route('admin.facilities.categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300" required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.facilities.categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-900">Update</button>
        </div>
    </form>
</div>

@endsection
}}