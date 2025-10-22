@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10 py-10">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Comments & Likes Management
        </h1>
        <p class="text-gray-500 mt-2">Monitor, review, and manage all engagement across Hogwarts content</p>
    </div>

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-10 text-center">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-800 transition">Dashboard</a> /
        <span class="text-gray-400">Comments & Likes</span>
    </nav>

    {{-- Statistics Cards --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="w-1.5 h-8 bg-gradient-to-b from-[#b03535] via-[#3c5e5e] to-[#425d9e] rounded-full"></span>
            Engagement Overview
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Facility Photos Stats --}}
            <div class="rounded-2xl bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-[#425d9e] uppercase mb-1">Facility Photos</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['facility_photos']['total_likes'] }}</h3>
                        <p class="text-sm text-gray-500">Total Likes</p>
                    </div>
                    <i class="fas fa-images text-4xl text-gray-300"></i>
                </div>
                <p class="text-sm text-gray-600 mb-3">
                    {{ $stats['facility_photos']['total_comments'] }} Comments
                    @if($stats['facility_photos']['pending_comments'] > 0)
                        <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">
                            {{ $stats['facility_photos']['pending_comments'] }} Pending
                        </span>
                    @endif
                </p>
                <a href="{{ route('admin.comments.facility-photos') }}" 
                   class="inline-block px-4 py-2 bg-gradient-to-r from-[#425d9e] to-[#3c5e5e] text-white text-sm rounded-lg hover:opacity-90 transition">
                    View Comments
                </a>
            </div>

            {{-- Hogwarts Prophet Stats --}}
            <div class="rounded-2xl bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-[#3c5e5e] uppercase mb-1">Hogwarts Prophet</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['hogwarts_prophet']['total_likes'] }}</h3>
                        <p class="text-sm text-gray-500">Total Likes</p>
                    </div>
                    <i class="fas fa-newspaper text-4xl text-gray-300"></i>
                </div>
                <p class="text-sm text-gray-600 mb-3">
                    {{ $stats['hogwarts_prophet']['total_comments'] }} Comments
                    @if($stats['hogwarts_prophet']['pending_comments'] > 0)
                        <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">
                            {{ $stats['hogwarts_prophet']['pending_comments'] }} Pending
                        </span>
                    @endif
                </p>
                <a href="{{ route('admin.comments.hogwarts-prophet') }}" 
                   class="inline-block px-4 py-2 bg-gradient-to-r from-[#3c5e5e] to-[#425d9e] text-white text-sm rounded-lg hover:opacity-90 transition">
                    View Comments
                </a>
            </div>

            {{-- Achievements Stats --}}
            <div class="rounded-2xl bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs font-semibold text-[#b03535] uppercase mb-1">Achievements</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['achievements']['total_likes'] }}</h3>
                        <p class="text-sm text-gray-500">Total Likes</p>
                    </div>
                    <i class="fas fa-trophy text-4xl text-gray-300"></i>
                </div>
                <p class="text-sm text-gray-600 mb-3">
                    {{ $stats['achievements']['total_comments'] }} Comments
                    @if($stats['achievements']['pending_comments'] > 0)
                        <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">
                            {{ $stats['achievements']['pending_comments'] }} Pending
                        </span>
                    @endif
                </p>
                <a href="{{ route('admin.comments.achievements') }}" 
                   class="inline-block px-4 py-2 bg-gradient-to-r from-[#b03535] to-[#3c5e5e] text-white text-sm rounded-lg hover:opacity-90 transition">
                    View Comments
                </a>
            </div>
        </div>
    </section>

    {{-- Quick Actions --}}
    <section class="px-2 lg:px-4">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="w-1.5 h-8 bg-gradient-to-b from-[#b03535] via-[#3c5e5e] to-[#425d9e] rounded-full"></span>
            Quick Actions
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.comments.facility-photos') }}" 
               class="flex items-center justify-center px-4 py-3 border-2 border-[#425d9e] text-[#425d9e] rounded-lg hover:bg-[#425d9e]/10 transition">
                <i class="fas fa-images mr-2"></i> Facility Comments
            </a>
            <a href="{{ route('admin.comments.hogwarts-prophet') }}" 
               class="flex items-center justify-center px-4 py-3 border-2 border-[#3c5e5e] text-[#3c5e5e] rounded-lg hover:bg-[#3c5e5e]/10 transition">
                <i class="fas fa-newspaper mr-2"></i> Prophet Comments
            </a>
            <a href="{{ route('admin.comments.achievements') }}" 
               class="flex items-center justify-center px-4 py-3 border-2 border-[#b03535] text-[#b03535] rounded-lg hover:bg-[#b03535]/10 transition">
                <i class="fas fa-trophy mr-2"></i> Achievement Comments
            </a>
            <a href="{{ route('admin.comments.likes-stats') }}" 
               class="flex items-center justify-center px-4 py-3 border-2 border-[#425d9e] text-[#425d9e] rounded-lg hover:bg-[#425d9e]/10 transition">
                <i class="fas fa-heart mr-2"></i> Likes Statistics
            </a>
        </div>
    </section>
</div>
@endsection
