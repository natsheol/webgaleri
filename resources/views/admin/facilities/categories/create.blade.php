@extends('layouts.manage')

@section('title', 'Add Facility Category')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Facilities', 'route' => route('admin.facilities.index')],
        ['label' => 'Add Category', 'route' => null],
    ];
@endphp

@section('content')
<div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Add New Facility Category
        </h1>
        <p class="text-gray-500 mt-2">Create a new category for organizing school facilities</p>
    </div>
<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10 py-10">
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

        <form action="{{ route('admin.facilities.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold mb-2">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none" required>
            </div>

            <div>
                <label class="block font-semibold mb-2">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none" required>
            </div>

            <div>
                <label class="block font-semibold mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" 
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="h-5 w-5 text-[#425d9e]">
                <label for="is_active" class="font-medium text-gray-700">Active</label>
            </div>

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
                    Create category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
