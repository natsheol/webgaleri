@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Student</h1>

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white p-8 rounded-3xl shadow-lg max-w-3xl mx-auto flex flex-col gap-6 items-center">
            {{-- Photo on top --}}
            <div class="w-48 h-60 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center relative">
                @if($student->photo)
                    <img id="photoPreview" src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="object-cover w-full h-full">
                    <span id="photoPlaceholder" class="hidden">Photo</span>
                @else
                    <img id="photoPreview" src="#" alt="Student Photo" class="object-cover w-full h-full hidden">
                    <span id="photoPlaceholder" class="text-gray-400 text-center px-2">Photo</span>
                @endif
                <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewPhoto(event)">
            </div>

            {{-- Input fields --}}
            <div class="w-full flex flex-col gap-4">
                <div>
                    <label class="block font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" class="w-full border rounded p-3" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}" class="w-full border rounded p-3">
                </div>

                <div>
                    <label class="block font-medium mb-1">Year</label>
                    <input type="text" name="year" value="{{ old('year', $student->year) }}" class="w-full border rounded p-3" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">House</label>
                    <select name="house_id" class="w-full border rounded p-3" required>
                        <option value="">Select House</option>
                        @foreach($houses as $house)
                            <option value="{{ $house->id }}" {{ old('house_id', $student->house_id) == $house->id ? 'selected' : '' }}>
                                {{ $house->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Full-width button --}}
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 mt-4 w-full text-lg font-semibold">
                    Update Student
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function previewPhoto(event) {
    const preview = document.getElementById('photoPreview');
    const placeholder = document.getElementById('photoPlaceholder');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('hidden');
    placeholder.classList.add('hidden');
}
</script>
@endsection
