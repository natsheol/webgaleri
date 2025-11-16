{{-- resources/views/admin/facilities/photos/edit.blade.php --}}
@extends('layouts.manage')

@section('title', 'Edit Facility Photo')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Facilities', 'route' => route('admin.facilities.index')],
        ['label' => 'Edit Photo', 'route' => null],
    ];
@endphp

@section('content')
<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10 py-10">
    <div class="text-center mb-12">
    <h1 class="text-2xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
        Edit Photo: {{ $photo->name }}
    </h1>
    <p class="text-gray-500">Update photo details for this facility category</p>
</div>
    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        {{-- Errors --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-6 rounded-lg shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.facilities.categories.photos.update', [$category->id, $photo->id]) }}" 
              method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Photo Name --}}
            <div>
                <label class="block font-semibold mb-2">Photo Name</label>
                <input type="text" name="name" value="{{ old('name', $photo->name) }}" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">{{ old('description', $photo->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Current Image --}}
            <div>
                <label class="block font-semibold mb-2">Current Image</label>
                <img src="{{ $photo->image ? asset('storage/'.$photo->image) : 'https://via.placeholder.com/400x300' }}" 
                     alt="{{ $photo->name }}" class="w-full h-48 object-cover rounded-xl mb-2">
            </div>

            {{-- Change Image --}}
            <div>
                <label class="block font-semibold mb-2">Change Image (optional)</label>
                <input type="file" name="image" class="w-full">
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Set as Cover Photo --}}
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="set_as_cover" value="1" class="mr-2"
                        {{ $category->cover_photo_id == $photo->id ? 'checked' : '' }}>
                    Set as cover photo for this category
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 pt-6">
                <a href="{{ route('admin.facilities.index') }}"
                   class="px-6 py-2.5 rounded-xl border border-gray-300 bg-gray-100 
                          text-gray-700 font-medium hover:bg-gray-200 transition shadow-sm">
                    Cancel
                </a>

                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-semibold text-white 
                           bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e]
                           hover:opacity-90 shadow-md transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
