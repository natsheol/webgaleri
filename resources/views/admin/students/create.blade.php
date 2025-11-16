@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">Add New Student</h1>

    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white p-8 rounded-3xl shadow-lg max-w-3xl mx-auto flex flex-col gap-6 items-center">
            {{-- Photo --}}
            <div id="dropArea" class="w-48 h-60 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center relative border-2 border-dashed border-gray-300 cursor-pointer">
                <img id="photoPreview" src="#" class="object-cover w-full h-full hidden">
                <span id="photoPlaceholder" class="text-gray-400 text-center px-2">Photo</span>
                <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>
            <small class="text-gray-500 text-center block mt-2">Drag & drop image, paste (Ctrl/Cmd+V), or click to select</small>

            {{-- Input fields --}}
            <div class="w-full flex flex-col gap-4 mt-4">
                <div>
                    <label class="block font-medium mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-3" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border rounded p-3">
                </div>

                <div>
                    <label class="block font-medium mb-1">Year</label>
                    <input type="text" name="year" value="{{ old('year') }}" class="w-full border rounded p-3" required>
                </div>

                <div>
                    <label class="block font-medium mb-1">House</label>
                    <select name="house_id" class="w-full border rounded p-3" required>
                        <option value="">Select House</option>
                        @foreach($houses as $house)
                            <option value="{{ $house->id }}" {{ old('house_id') == $house->id ? 'selected' : '' }}>
                                {{ $house->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 mt-4 w-full text-lg font-semibold">
                    Add Student
                </button>
            </div>
        </div>
    </form>
</div>

<script>
const dropArea = document.getElementById('dropArea');
const photoInput = dropArea.querySelector('input[type="file"]');
const preview = document.getElementById('photoPreview');
const placeholder = document.getElementById('photoPlaceholder');

// Klik untuk pilih file
dropArea.addEventListener('click', () => photoInput.click());

// Drag & Drop
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('border-blue-500');
});
dropArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropArea.classList.remove('border-blue-500');
});
dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('border-blue-500');
    const file = e.dataTransfer.files[0];
    if (file) handleFile(file);
});

// Paste dari clipboard
dropArea.addEventListener('paste', (e) => {
    const items = e.clipboardData.items;
    for (let item of items) {
        if (item.type.indexOf('image') !== -1) {
            const file = item.getAsFile();
            handleFile(file);
        }
    }
});

// Input file biasa
photoInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) handleFile(file);
});

// Fungsi preview + set file ke input
function handleFile(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);

    // Set file ke input untuk submit
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    photoInput.files = dataTransfer.files;
}
</script>
@endsection
