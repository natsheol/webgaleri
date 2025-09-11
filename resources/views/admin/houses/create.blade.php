@extends('layouts.manage')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Add House</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.houses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">House Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Characteristics (comma separated)</label>
            <input type="text" name="characteristics" value="{{ old('characteristics') }}"
                   placeholder="e.g., Brave, Loyal"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Logo</label>
            <input type="file" name="logo" class="w-full">
        </div>

        <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded shadow hover:bg-amber-900">Save</button>
    </form>
</div>
@endsection
