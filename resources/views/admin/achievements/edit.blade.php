@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Achievement</h1>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.achievements.update', $achievement->id) }}" method="POST" enctype="multipart/form-data" 
          class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $achievement->title) }}" required
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">{{ old('description', $achievement->description) }}</textarea>
        </div>

        {{-- House --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">House</label>
            <select name="house_id"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">
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
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" 
                value="{{ old('date', $achievement->date ? \Carbon\Carbon::parse($achievement->date)->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">
        </div>

        {{-- Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <input type="file" name="image" accept="image/*"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">
            
            @if ($achievement->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$achievement->image) }}" alt="Current Image" class="h-32 rounded shadow">
                </div>
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-amber-700 text-white rounded-lg shadow hover:bg-amber-900 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
