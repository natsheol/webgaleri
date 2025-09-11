@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold mb-6">Edit Hogwarts Prophet</h2>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hogwarts-prophet.update', $news->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow rounded-lg p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                   class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">
        </div>

        <div>
            <label class="block font-semibold mb-1">Main Content</label>
            <textarea name="content" rows="15" required
                      class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-amber-700">{{ old('content', $news->content) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Writer</label>
                <input type="text" name="writer" value="{{ old('writer', $news->writer) }}"
                       class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block font-semibold mb-1">Date</label>
                <input type="date" name="date"
                       value="{{ old('date', $news->date ? \Carbon\Carbon::parse($news->date)->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 p-2 rounded">
            </div>
        </div>
            
        <div>
            <label class="block font-semibold mb-1">Documentation</label>
            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded">
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
                    class="bg-amber-700 text-white px-6 py-2 rounded hover:bg-amber-900 transition-all">
                Update Hogwarts Prophet
            </button>
        </div>
    </form>
    
</div>
@endsection
