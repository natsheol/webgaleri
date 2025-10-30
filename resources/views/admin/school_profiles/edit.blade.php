@extends('layouts.manage')

@section('title', 'Edit School Profile')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">

    <form action="{{ route('admin.school-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ABOUT SCHOOL --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                About School
            </h2>

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
                                <img src="{{ asset('storage/' . $profile->logo) }}" alt="School Logo" class="h-16 w-auto rounded-md shadow">
                            </div>
                        @endif
                        <div class="flex-grow">
                            <input type="file" name="logo" id="logo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG — Max 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="about" class="block text-sm font-medium text-gray-700 mb-1">About School</label>
                <textarea name="about" id="about" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('about', $profile->about) }}</textarea>
            </div>
        </div>

        {{-- CONTACT & ADDRESS --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Contact & Address
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" id="address" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('address', $profile->address) }}</textarea>
                </div>

                <div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="map_embed" class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed</label>
                <textarea name="map_embed" id="map_embed" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('map_embed', $profile->map_embed) }}</textarea>
            </div>
        </div>

        {{-- VISION & MISSION --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Vision & Mission
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                    <textarea name="vision" id="vision" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('vision', $profile->vision) }}</textarea>
                </div>

                <div>
                    <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                    <textarea name="mission" id="mission" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-amber-500">{{ old('mission', $profile->mission) }}</textarea>
                </div>
            </div>
        </div>

        {{-- SOCIAL MEDIA --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Social Media
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $profile->facebook_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-pink-500">
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $profile->youtube_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-500">
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                    <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-sky-500">
                </div>
            </div>
        </div>

        {{-- HERO & FOUNDING INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                    Hero Section
                </h2>

                <div>
                    <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-1">Hero Image</label>
                    @if($profile->hero_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $profile->hero_image) }}" alt="Hero Image" class="h-32 w-auto rounded-lg shadow">
                        </div>
                    @endif
                    <input type="file" name="hero_image" id="hero_image" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                    Founding Information
                </h2>

                <label for="founded_year" class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                <input type="number" name="founded_year" id="founded_year" value="{{ old('founded_year', $profile->founded_year) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        {{-- FOUNDERS --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-8 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Founders
            </h2>

            @if($profile->founders->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($profile->founders as $founder)
                        <a href="{{ route('admin.school-profile.founders.edit', $founder->id) }}" class="relative block bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition overflow-hidden">
                            <div class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="w-5 h-5">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                    </g>
                                </svg>
                            </div>

                            <img src="{{ $founder->photo ? asset('storage/' . $founder->photo) : asset('images/default-avatar.png') }}" alt="{{ $founder->name }}" class="h-20 w-20 rounded-full object-cover mx-auto mb-3 border-2 border-gray-300">
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

        {{-- SAVE BUTTON --}}
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#425d9e] via-[#3c5e5e] to-[#b03535] text-white rounded-xl font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all" id="submitBtn">
                <i class="fas fa-save mr-1"></i> Save Changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...';
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                Swal.fire({
                    title: 'Success!',
                    text: result.message,
                    icon: 'success',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                }).then(() => {
                    window.location.href = result.redirect;
                });
            } else {
                throw new Error(result.message || 'Failed to update profile');
            }
        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save mr-1"></i> Save Changes';
        }
    });
});
</script>
@endpush

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#3b82f6',
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    });
</script>
@endif
@endpush
