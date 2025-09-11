@extends('layouts.manage')

@section('title', 'School Profile')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Manage Profile School</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.school-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                <p class="font-bold">Something Error:</p>
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">About School</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">School Name <span class="text-red-600">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $profile->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500" required>
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">School Logo</label>
                    <div class="flex items-start space-x-4">
                        @if($profile->logo)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo Sekolah" class="h-16 w-auto">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <input type="file" name="logo" id="logo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="about" class="block text-sm font-medium text-gray-700 mb-1">About School </label>
                <textarea name="about" id="about" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('about', $profile->about) }}</textarea>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Contact & Address</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" id="address" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('address', $profile->address) }}</textarea>
                </div>

                <div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="map_embed" class="block text-sm font-medium text-gray-700 mb-1">Embed Google Maps</label>
                <textarea name="map_embed" id="map_embed" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('map_embed', $profile->map_embed) }}</textarea>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Vision & Mission</h3>
            
            <div class="mb-4">
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                <textarea name="vision" id="vision" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('vision', $profile->vision) }}</textarea>
            </div>

            <div>
                <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                <textarea name="mission" id="mission" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('mission', $profile->mission) }}</textarea>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Social Media</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $profile->facebook_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $profile->youtube_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                    <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fas fa-save mr-1"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
