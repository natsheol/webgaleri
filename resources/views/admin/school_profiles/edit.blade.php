@extends('layouts.manage')

@section('title', 'School Profile')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Manage School Profile</h2>
    </div>

    <form action="{{ route('admin.school-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- About School --}}
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
                    <label for="about" class="block text-sm font-medium text-gray-700 mb-1">About School</label>
                    <textarea name="about" id="about" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('about', $profile->about) }}</textarea>
                </div>
            </div>


            {{--address and contact--}}
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
                <textarea name="map_embed" id="map_embed" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('map_embed', $profile->map_embed) }}</textarea>
            </div>
        </div>

        {{-- vision n Mission --}}
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Vision & Mission</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                    <textarea name="vision" id="vision" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('vision', $profile->vision) }}</textarea>
                </div>

                <div>
                    <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                    <textarea name="mission" id="mission" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('mission', $profile->mission) }}</textarea>
                </div>
            </div>
        </div>

        {{-- social media --}}
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


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- hero image --}}
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Hero Section</h3>
                    
                    <div class="mb-4">
                        <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-1">Hero Image</label>
                        @if($profile->hero_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $profile->hero_image) }}" 
                                    alt="Hero Image" class="h-32 w-auto rounded-lg shadow">
                            </div>
                        @endif
                        <input type="file" name="hero_image" id="hero_image" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- ✅ BAGIAN FOUNDING INFO --}}
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Founding Info</h3>
                    
                    <div class="mb-4">
                        <label for="founded_year" class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                        <input type="number" name="founded_year" id="founded_year" 
                            value="{{ old('founded_year', $profile->founded_year) }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
        </div>

        {{-- founder --}}
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Founders</h3>

            @if($profile->founders->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($profile->founders as $founder)
                        <a href="{{ route('admin.school-profile.founders.edit', $founder->id) }}" 
                        class="relative block bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition overflow-hidden">
                        
                            {{-- Icon SVG di pojok kanan atas --}}
                            <div class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                    class="w-5 h-5">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                    </g>
                                </svg>
                            </div>

                            {{-- Founder Photo --}}
                            <img src="{{ $founder->photo ? asset('storage/' . $founder->photo) : asset('images/default-avatar.png') }}" 
                                alt="{{ $founder->name }}" 
                                class="h-20 w-20 rounded-full object-cover mx-auto mb-3 border-2 border-gray-300">

                            <h4 class="text-md font-bold text-gray-800">{{ $founder->name }}</h4>
                            <p class="text-sm text-gray-500">Born {{ $founder->birth_year }}</p>
                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($founder->description, 60) }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No founders added yet.</p>
            @endif
        </div>


        {{-- ✅ TOMBOL SAVE --}}
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fas fa-save mr-1"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
