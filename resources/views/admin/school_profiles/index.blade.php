@extends('layouts.manage')

@section('title', 'School Profile')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">School Profile Overview</h2>
        <a href="{{ route('admin.school-profile.edit') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            <i class="fas fa-edit mr-1"></i> Manage School Profile
        </a>
    </div>

    {{-- Hero Image --}}
    @if($profile->hero_image)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $profile->hero_image) }}" 
                 alt="Hero Image" 
                 class="w-full h-64 object-cover rounded-lg shadow">
        </div>
    @endif

    {{-- School Logo & Name --}}
    <div class="flex items-center mb-8">
        @if($profile->logo)
            <img src="{{ asset('storage/' . $profile->logo) }}" 
                 alt="Logo Sekolah" class="h-20 w-20 object-contain mr-4">
        @endif
        <h1 class="text-2xl font-bold text-gray-900">{{ $profile->title ?? '-' }}</h1>
    </div>

    {{-- Founding Info --}}
    <div class="bg-gray-50 shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Founding Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500">Founded Year</p>
                <p class="text-gray-700 mb-4">{{ $profile->founded_year ?? '-' }}</p>
            </div>
            <div class="flex items-start space-x-4">
                @if($profile->founder_photo)
                    <img src="{{ asset('storage/' . $profile->founder_photo) }}" 
                         alt="Founder Photo" class="h-20 w-20 object-cover rounded-full">
                @endif
            </div>
        </div>
        <div class="mt-10 bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Founders of Hogwarts</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($profile->founders as $founder)
                            <div class="bg-gray-50 rounded-lg shadow-sm p-4 flex flex-col items-center text-center">
                                <img src="{{ asset('storage/' . $founder->photo) }}" 
                                    alt="{{ $founder->name }}" 
                                    class="h-24 w-24 rounded-full object-cover mb-3 border-2 border-gray-300">

                                <h3 class="text-lg font-bold text-gray-800">{{ $founder->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">Born {{ $founder->birth_year }}</p>
                                <p class="text-gray-600 text-sm">{{ $founder->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

    </div>

    {{-- About + Vision & Mission --}}
    <div class="bg-gray-50 shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">About</h2>
        <p class="text-gray-600 whitespace-pre-line mb-6">{{ $profile->about ?? '-' }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Vision -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Vision</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $profile->vision ?? '-' }}</p>
            </div>

            <!-- Mission -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Mission</h3>
                <p class="text-gray-600 whitespace-pre-line">{{ $profile->mission ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Contact + Social Media + Location (3 separate cards) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Contact & Address -->
        <div class="bg-gray-50 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Contact & Address</h3>
            <p class="text-sm font-medium text-gray-500">Address</p>
            <p class="text-gray-700 mb-3">{{ $profile->address ?? '-' }}</p>

            <p class="text-sm font-medium text-gray-500">Phone</p>
            <p class="text-gray-700 mb-3">{{ $profile->phone ?? '-' }}</p>

            <p class="text-sm font-medium text-gray-500">Email</p>
            <p class="text-gray-700">{{ $profile->email ?? '-' }}</p>
        </div>

        <!-- Social Media -->
        <div class="bg-gray-50 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Social Media</h3>
            <ul class="space-y-2">
                @if($profile->facebook_url)
                    <li><span class="font-medium">Facebook:</span> 
                        <a href="{{ $profile->facebook_url }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $profile->facebook_url }}
                        </a>
                    </li>
                @endif
                @if($profile->instagram_url)
                    <li><span class="font-medium">Instagram:</span> 
                        <a href="{{ $profile->instagram_url }}" target="_blank" class="text-pink-600 hover:underline">
                            {{ $profile->instagram_url }}
                        </a>
                    </li>
                @endif
                @if($profile->youtube_url)
                    <li><span class="font-medium">YouTube:</span> 
                        <a href="{{ $profile->youtube_url }}" target="_blank" class="text-red-600 hover:underline">
                            {{ $profile->youtube_url }}
                        </a>
                    </li>
                @endif
                @if($profile->twitter_url)
                    <li><span class="font-medium">Twitter:</span> 
                        <a href="{{ $profile->twitter_url }}" target="_blank" class="text-sky-600 hover:underline">
                            {{ $profile->twitter_url }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Location -->
        <div class="bg-gray-50 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Location</h3>
            @if($profile->map_embed)
                <div class="aspect-w-4 aspect-h-9">
                    {!! $profile->map_embed !!}
                </div>
            @else
                <p class="text-gray-600">No map available</p>
            @endif
        </div>
    </div>
</div>
@endsection
