{{-- resources/views/admin/achievements/edit.blade.php --}}
@extends('layouts.manage')

@section('title', 'Edit Achievement')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Achievements', 'route' => route('admin.achievements.index')],
        ['label' => 'Edit', 'route' => null],
    ];
@endphp

@section('content')
{{-- Header --}}
    <div class="text-center mb-4">
        <h1 class="text-2xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Edit Achievement
        </h1>
        <p class="text-gray-500">Update the details of the Hogwarts Achievement</p>
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

        <form action="{{ route('admin.achievements.update', $achievement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block font-semibold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $achievement->title) }}" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="5"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">{{ old('description', $achievement->description) }}</textarea>
            </div>

            {{-- House --}}
            <div>
                <label class="block font-semibold mb-2">House</label>
                <select name="house_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
                    <option value="">-- No House --</option>
                    @foreach ($houses as $house)
                        <option value="{{ $house->id }}" {{ old('house_id', $achievement->house_id ?? '') == $house->id ? 'selected' : '' }}>
                            {{ $house->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div>
                <label class="block font-semibold mb-2">Date</label>
                <input type="date" name="date"
                       value="{{ old('date', $achievement->date ? \Carbon\Carbon::parse($achievement->date)->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#3c5e5e] focus:outline-none">
            </div>

            {{-- Image --}}
            <div>
                <label class="block font-semibold mb-2">Image</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded-xl px-4 py-2">

                @php use Illuminate\Support\Str; @endphp
                <div class="mt-4">
                    @if (!empty($achievement->image) && (Str::startsWith($achievement->image, 'http') || file_exists(public_path('storage/' . $achievement->image))))
                        <img src="{{ Str::startsWith($achievement->image, 'http') ? $achievement->image : asset('storage/' . $achievement->image) }}"
                             alt="Achievement Image" class="w-full h-48 object-cover rounded-lg shadow">
                    @else
                        <div class="w-full h-48 flex items-center justify-center bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg shadow">
                            <i class="fas fa-trophy text-4xl opacity-50"></i>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 pt-6">
                <a href="{{ route('admin.achievements.index') }}"
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
