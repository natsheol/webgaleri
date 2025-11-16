{{-- resources/views/admin/facilities/photos/create.blade.php --}}
@extends('layouts.manage')

@section('title', 'Add Facility Photo')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Facilities', 'route' => route('admin.facilities.index')],
        ['label' => 'Add Photo', 'route' => null],
    ];
@endphp

@section('content')
<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10 py-10">
    <div class="text-center mb-4">
        <h1 class="text-2xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Add Photo to {{ $category->name }}
        </h1>
        <p class="text-gray-500">Upload a new photo and description for this facility category</p>
    </div>
    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-6 rounded-lg shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.facilities.categories.photos.store', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold mb-2">Photo Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Photo Image</label>
                <input type="file" name="image" class="w-full">
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex space-x-3">
                <button type="submit" 
                        class="px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white font-semibold rounded-xl shadow hover:opacity-90 transition">
                    Add Photo
                </button>
                <a href="{{ route('admin.facilities.index', $category->id) }}" 
                   class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-xl shadow hover:bg-gray-500 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
