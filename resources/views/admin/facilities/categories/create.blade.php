@extends('layouts.manage')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Add Category</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.facilities.categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Input Name -->
        <div>
            <label class="block mb-1 font-semibold">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <!-- Optional: Input Slug jika mau custom (bisa dihapus) -->
        {{-- 
        <div>
            <label class="block mb-1 font-semibold">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        --}}

        <button type="submit"
                class="px-4 py-2 bg-amber-700 text-white rounded-lg shadow hover:bg-amber-900">
            Save
        </button>
    </form>
</div>
@endsection
