@extends('layouts.manage')

@section('title', 'Edit Founder')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Edit Founder</h1>
        <p class="text-gray-600">Update founder information and photo</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.school-profile.founders.update', $founder->id) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        {{-- Hidden field for school profile ID --}}
        <input type="hidden" name="school_profile_id" value="{{ $founder->school_profile_id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $founder->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Birth Year --}}
            <div>
                <label for="birth_year" class="block text-sm font-medium text-gray-700 mb-2">Birth Year <span class="text-red-500">*</span></label>
                <input type="number" name="birth_year" id="birth_year" value="{{ old('birth_year', $founder->birth_year) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('birth_year') border-red-500 @enderror" 
                       required>
                @error('birth_year')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                      placeholder="Enter founder's description...">{{ old('description', $founder->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Photo Upload Section --}}
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Photo</h3>
            
            {{-- File Input --}}
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Upload New Photo</label>
                <div class="flex items-center space-x-4">
                    <input type="file" name="photo" id="photo" accept="image/*" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('photo') border-red-500 @enderror">
                    <span class="text-sm text-gray-500">Max size: 4MB</span>
                </div>
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Photo Display --}}
            @if($founder->photo)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Current Photo:</p>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $founder->photo) }}" 
                             alt="{{ $founder->name }}" 
                             class="h-24 w-24 rounded-full object-cover border-2 border-gray-300 shadow-sm">
                        <div>
                            <p class="text-sm text-gray-600">{{ $founder->name }}</p>
                            <p class="text-xs text-gray-500">Current photo</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                    <p class="text-sm text-yellow-700">No photo uploaded yet. Upload a photo to display the founder's image.</p>
                </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
            <a href="{{ route('admin.school-profile.founders.index') }}" 
               class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                <i class="fas fa-save mr-2"></i>Update Founder
            </button>
        </div>
    </form>
</div>

<script>
// File input preview functionality
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // You can add preview functionality here if needed
            console.log('File selected:', file.name);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
