@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">My Profile</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
                <div class="flex">
                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                    <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Sidebar --}}
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    {{-- Avatar --}}
                    <div class="mb-4">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                        @else
                            <div class="w-32 h-32 rounded-full mx-auto bg-gradient-to-br from-[#b03535] via-[#3c5e5e] to-[#425d9e] flex items-center justify-center text-white text-4xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                    <p class="text-xs text-gray-500 mt-2">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="md:col-span-2 space-y-6">
                {{-- Liked Photos --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-heart text-red-500"></i> Liked Photos ({{ $likedPhotos->count() }})
                    </h3>
                    
                    @if($likedPhotos->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($likedPhotos as $like)
                                @if($like->photo)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $like->photo->image) }}" 
                                             alt="{{ $like->photo->name }}" 
                                             class="w-full h-32 object-cover rounded-lg">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition rounded-lg flex items-center justify-center">
                                            <p class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition px-2 text-center">
                                                {{ $like->photo->name }}
                                            </p>
                                        </div>
                                        <span class="absolute top-2 right-2 bg-gray-800 bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                            {{ $like->photo->category->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">You haven't liked any photos yet.</p>
                    @endif
                </div>

                {{-- Comment History --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-comments text-blue-500"></i> Comment History ({{ $allComments->count() }})
                    </h3>
                    
                    @if($allComments->count() > 0)
                        <div class="space-y-3">
                            @foreach($allComments as $comment)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            @if($comment['type'] === 'facility')
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded">Facility</span>
                                            @elseif($comment['type'] === 'prophet')
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">Prophet</span>
                                            @else
                                                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded">Achievement</span>
                                            @endif
                                            
                                            @if($comment['is_approved'])
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">
                                                    <i class="fas fa-check"></i> Approved
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $comment['created_at']->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm font-medium text-gray-800 mb-1">On: {{ $comment['item_name'] }}</p>
                                    <p class="text-sm text-gray-600">{{ $comment['content'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">You haven't posted any comments yet.</p>
                    @endif
                </div>
                {{-- Update Profile --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Update Profile</h3>
                    
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::user()->name) }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', Auth::user()->email) }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Avatar --}}
                            <div>
                                <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                                <input type="file" 
                                       id="avatar" 
                                       name="avatar" 
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                                @error('avatar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full px-6 py-3 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg hover:opacity-90 transition">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Change Password --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Change Password</h3>
                    
                    <form action="{{ route('user.password.change') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            {{-- Current Password --}}
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" 
                                       id="new_password" 
                                       name="new_password" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                                @error('new_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm New Password --}}
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" 
                                       id="new_password_confirmation" 
                                       name="new_password_confirmation" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#425d9e] focus:border-transparent">
                            </div>

                            <button type="submit" 
                                    class="w-full px-6 py-3 bg-gradient-to-r from-[#425d9e] via-[#3c5e5e] to-[#b03535] text-white rounded-lg hover:opacity-90 transition">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
