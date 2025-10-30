@extends('layouts.manage')

@section('title', 'Edit Founder')

@section('content')
<div class="bg-white text-gray-900 p-8 rounded-2xl shadow-xl border border-gray-200">

    {{-- Heading --}}
    <div class="mb-8 border-b border-gray-300 pb-4">
        <h1 class="text-3xl font-extrabold flex items-center gap-3">
            <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
            Edit Founder
        </h1>
        <p class="text-gray-500 mt-1">Update founder’s information and profile photo</p>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.school-profile.founders.update', $founder->id) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <input type="hidden" name="school_profile_id" value="{{ $founder->school_profile_id }}">

        {{-- Name + Birth Year --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-800 mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $founder->name) }}"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:ring-2 focus:ring-[#425d9e] focus:border-[#425d9e] transition @error('name') border-red-500 @enderror" 
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Birth Year --}}
            <div>
                <label for="birth_year" class="block text-sm font-semibold text-gray-800 mb-2">Birth Year <span class="text-red-500">*</span></label>
                <input type="number" name="birth_year" id="birth_year" value="{{ old('birth_year', $founder->birth_year) }}"
                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:ring-2 focus:ring-[#425d9e] focus:border-[#425d9e] transition @error('birth_year') border-red-500 @enderror" 
                       required>
                @error('birth_year')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Description</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:ring-2 focus:ring-[#425d9e] focus:border-[#425d9e] transition resize-none @error('description') border-red-500 @enderror"
                      placeholder="Enter founder's biography...">{{ old('description', $founder->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Photo Upload Section --}}
        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-300 shadow-inner">
            <h3 class="text-xl font-semibold mb-5 flex items-center gap-2 text-gray-800">
                <span class="w-1.5 h-6 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Founder Photo
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label for="photo" class="block text-sm font-semibold text-gray-800 mb-2">Upload New Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*" 
                           class="block w-full text-sm text-gray-800 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:font-semibold file:bg-gradient-to-r file:from-[#425d9e] file:via-[#3c5e5e] file:to-[#b03535] file:text-white hover:file:opacity-90 transition @error('photo') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Max size: 4MB</p>
                    @error('photo')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current Photo --}}
                @if($founder->photo)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Current Photo:</p>
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $founder->photo) }}" 
                                 alt="{{ $founder->name }}" 
                                 class="h-24 w-24 rounded-full object-cover border-2 border-[#3c5e5e] shadow-lg">
                            <div>
                                <p class="text-gray-800 font-medium">{{ $founder->name }}</p>
                                <p class="text-xs text-gray-500">Existing profile image</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-4 p-4 bg-yellow-100 border border-yellow-300 rounded-xl">
                        <p class="text-sm text-yellow-800">No photo uploaded yet. Upload a photo to display the founder’s profile.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end items-center gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.school-profile.index') }}" 
               class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition-colors text-gray-800">
                Cancel
            </a>
            <button type="submit" 
                class="px-6 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-[#425d9e] via-[#3c5e5e] to-[#b03535] hover:opacity-90 hover:scale-[1.02] transition-transform shadow-md">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
