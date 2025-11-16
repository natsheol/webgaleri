{{-- resources/views/admin/hogwarts-prophet/edit.blade.php --}}
@extends('layouts.manage')

@section('title', 'Edit Hogwarts Prophet')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Hogwarts Prophet', 'route' => route('admin.hogwarts-prophet.index')],
        ['label' => 'Edit', 'route' => null],
    ];
@endphp

@section('content')
{{-- Header --}}
    <div class="text-center mb-4">
        <h1 class="text-2xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Edit Hogwarts Prophet
        </h1>
        <p class="text-gray-500">Update the news entry for Hogwarts Prophet</p>
    </div>
<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10">
    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-sm p-6">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-6 rounded-lg shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.hogwarts-prophet.update', $news->id) }}" method="POST" enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block font-semibold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
            </div>

            {{-- Content --}}
            <div>
                <label class="block font-semibold mb-2">Main Content</label>
                <textarea name="content" rows="6" required
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">{{ old('content', $news->content) }}</textarea>
            </div>

            {{-- Writer & Date --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-2">Writer</label>
                    <input type="text" name="writer" value="{{ old('writer', $news->writer) }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Date</label>
                    <input type="date" name="date"
                           value="{{ old('date', $news->date ? \Carbon\Carbon::parse($news->date)->format('Y-m-d') : '') }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
                </div>
            </div>

            {{-- Image --}}
            <div>
                <label class="block font-semibold mb-2">Documentation</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            {{-- Preview / Placeholder --}}
            <div class="mb-6">
                @php use Illuminate\Support\Str; @endphp
                @if (!empty($news->image) && (Str::startsWith($news->image, 'http') || file_exists(public_path('storage/' . $news->image))))
                    <img src="{{ Str::startsWith($news->image, 'http') ? $news->image : asset('storage/' . $news->image) }}"
                         class="w-full h-48 object-cover rounded-lg shadow" alt="Thumbnail">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg shadow">
                        <i class="fas fa-scroll text-4xl opacity-50"></i>
                    </div>
                @endif
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 pt-6">
                <a href="{{ route('admin.hogwarts-prophet.index') }}"
                   class="px-6 py-2.5 rounded-xl border border-gray-300 bg-gray-100 
                          text-gray-700 font-medium hover:bg-gray-200 transition shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-semibold text-white 
                           bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e]
                           hover:opacity-90 shadow-md transition">
                    Save Prophet
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
