@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Professor</h1>

    <form action="{{ route('admin.professors.update', $professor->id) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $professor->name) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Position</label>
            <input type="text" name="position" value="{{ old('email', $professor->email) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Subject</label>
            <input type="text" name="subject" value="{{ old('subject', $professor->subject) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium mb-1">House</label>
            <select name="house_id" class="w-full border rounded p-2">
                <option value="">Select House</option>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}" {{ (old('house_id', $professor->house_id) == $house->id) ? 'selected' : '' }}>
                        {{ $house->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Update Professor
        </button>
    </form>
</div>
@endsection
