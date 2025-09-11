@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold mb-6">📰 Add New Hogwarts Prophet</h2>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hogwarts-prophet.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 space-y-5">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" placeholder="Hogwarts Prophet's Title"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700"
                value="{{ old('title') }}" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">News</label>
            <textarea name="content" rows="6" placeholder="Main Content"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700"
                required>{{ old('content') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Writer</label>
                <input type="text" name="writer" placeholder="Writer"
                    class="w-full border border-gray-300 p-2 rounded" value="{{ old('writer') }}">
            </div>

            <div>
                <label class="block font-semibold mb-1">Date</label>
                <input type="date" name="date"
                    class="w-full border border-gray-300 p-2 rounded" value="{{ old('date') }}">
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Documentation</label>
            <input type="file" name="image"
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div class="mb-6">
            @php use Illuminate\Support\Str; @endphp
            @if (!empty($news->image) && (Str::startsWith($news->image, 'http') || file_exists(public_path('storage/' . $news->image))))
                  <img src="{{ Str::startsWith($news->image, 'http') ? $news->image : asset('storage/' . $news->image) }}"
                    class="w-100% h-50 object-cover rounded-lg shadow" alt="Thumbnail">
            @else
                 <div class="w-100% h-50 flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg shadow">
                      <i class="fas fa-scroll text-4xl opacity-50"></i>
                </div>
            @endif
        </div>

        <div class="pt-4">
        <button type="submit"
            class="bg-amber-700 text-white px-6 py-2 rounded hover:bg-amber-800 shadow-md">
            Save Hogwarts Prophet
        </button>
        </div>
    </form>
</div>
@endsection
