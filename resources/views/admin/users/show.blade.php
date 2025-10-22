@extends('admin.layout')

@section('title', 'User Details')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">User Details</h1>
            <nav class="text-sm text-gray-600">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Users</a>
                <span class="mx-2">/</span>
                <span>{{ $user->name }}</span>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-center mb-6">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover mx-auto mb-4">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    
                    <div class="mt-4">
                        @if($user->status == 'active')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Active
                            </span>
                        @elseif($user->status == 'banned')
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-ban mr-1"></i> Banned
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Pending
                            </span>
                        @endif
                    </div>
                </div>

                <div class="border-t pt-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">User ID:</span>
                        <span class="font-semibold">{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Registered:</span>
                        <span class="font-semibold">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Login:</span>
                        <span class="font-semibold">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</span>
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i> Edit User
                    </a>
                    
                    @if($user->status == 'active')
                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition" onclick="return confirm('Ban this user?')">
                                <i class="fas fa-ban mr-2"></i> Ban User
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.activate', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-check-circle mr-2"></i> Activate User
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" onclick="return confirm('Delete this user permanently?')">
                            <i class="fas fa-trash mr-2"></i> Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Activity Stats -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Activity Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <div class="text-3xl font-bold text-blue-600">{{ $user->facilityPhotoLikes->count() }}</div>
                        <div class="text-sm text-gray-600">Photo Likes</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <div class="text-3xl font-bold text-green-600">{{ $user->facilityPhotoComments->count() }}</div>
                        <div class="text-sm text-gray-600">Photo Comments</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                        <div class="text-3xl font-bold text-purple-600">{{ $user->hogwartsProphetLikes->count() }}</div>
                        <div class="text-sm text-gray-600">Prophet Likes</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <div class="text-3xl font-bold text-yellow-600">{{ $user->hogwartsProphetComments->count() }}</div>
                        <div class="text-sm text-gray-600">Prophet Comments</div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <div class="text-3xl font-bold text-red-600">{{ $user->achievementLikes->count() }}</div>
                        <div class="text-sm text-gray-600">Achievement Likes</div>
                    </div>
                    <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-200">
                        <div class="text-3xl font-bold text-indigo-600">{{ $user->achievementComments->count() }}</div>
                        <div class="text-sm text-gray-600">Achievement Comments</div>
                    </div>
                </div>
            </div>

            <!-- Recent Comments -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Comments</h3>
                <div class="space-y-3">
                    @php
                        $allComments = collect()
                            ->merge($user->facilityPhotoComments->map(fn($c) => ['type' => 'Facility Photo', 'content' => $c->content, 'date' => $c->created_at]))
                            ->merge($user->hogwartsProphetComments->map(fn($c) => ['type' => 'Hogwarts Prophet', 'content' => $c->content, 'date' => $c->created_at]))
                            ->merge($user->achievementComments->map(fn($c) => ['type' => 'Achievement', 'content' => $c->content, 'date' => $c->created_at]))
                            ->sortByDesc('date')
                            ->take(5);
                    @endphp

                    @forelse($allComments as $comment)
                        <div class="p-3 bg-gray-50 rounded-lg border">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-semibold text-blue-600">{{ $comment['type'] }}</span>
                                <span class="text-xs text-gray-500">{{ $comment['date']->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-700">{{ Str::limit($comment['content'], 100) }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No comments yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
