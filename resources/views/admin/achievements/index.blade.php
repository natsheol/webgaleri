@extends('layouts.manage')

@section('title', 'Achievements')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Achievements', 'route' => null],
    ];
@endphp

@section('content')
<div class="text-center mb-8">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
        Achievements
    </h1>
    <p class="text-gray-500 mt-2">Manage, edit, publish, and archive all achievements</p>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.achievements.index') }}" class="flex gap-2 w-full mb-6">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search achievements..."
        autocomplete="off"
        class="flex-grow h-11 px-4 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#3c5e5e]"
    >
    <button type="submit"
        class="h-11 px-5 bg-gradient-to-r from-[#3c5e5e] to-[#425d9e] text-white rounded-xl hover:opacity-90 transition text-sm font-medium shadow">
        <i class="fas fa-search mr-1"></i> Search
    </button>
</form>

<div class="min-h-screen bg-white text-gray-800 px-6 lg:px-10 py-10">

    {{-- Add Button --}}
    <div class="flex justify-end mb-8 gap-4">
        <a href="{{ route('admin.achievements.create') }}"
           class="h-11 px-5 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-xl shadow font-medium hover:opacity-90 transition flex items-center whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i> New Achievement
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
            <i class="fas fa-check-circle text-green-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Achievement List --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse ($achievements as $item)
        
            <div class="flex flex-col md:flex-row gap-5 bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden p-5 hover:shadow-md transition">

                {{-- Image --}}
                <div class="w-full md:w-44 aspect-[5/3] flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                    @if(!empty($item->image) && file_exists(public_path('storage/' . $item->image)))
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover" alt="Achievement Image">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-50">
                            <i class="fas fa-trophy text-4xl opacity-40"></i>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $item->title }}</h2>
                            {{-- House Badge --}}
                                @php
                                    $houseColors = [
                                        'Gryffindor' => 'gradient from-[#5c0c0c] to-[#8a3333]', // merah
                                        'Slytherin' => 'gradient from-[#063015] to-[#336343]',  // hijau
                                        'Ravenclaw' => 'gradient from-[#182552] to-[#6e8ab5]',  // biru
                                        'Hufflepuff' => 'gradient from-[#59510a] to-[#ab8e37]', // kuning
                                    ];

                                    $houseName = $item->house->name ?? null;
                                    $gradient = $houseName && isset($houseColors[$houseName])
                                        ? $houseColors[$houseName]
                                        : 'from-gray-300 to-gray-400';
                                @endphp

                                @if($houseName)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gradient-to-r {{ $gradient }} text-white shadow-sm">
                                        {{ $houseName }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">
                                        No House
                                    </span>
                                @endif
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ Str::limit($item->description, 250) }}</p>
                    </div>

                    <div class="mt-4 flex flex-col md:flex-row justify-between items-start md:items-end text-sm text-gray-500 gap-3">
                        {{-- Info --}}
                        <div>
                            <p class="text-xs text-gray-400">
                                {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '-' }}
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-3">
                            {{-- Edit --}}
                            <a href="{{ route('admin.achievements.edit', $item->id) }}"
                               class="text-yellow-500 hover:text-yellow-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18" />
                                    <path d="M7 17v-4l10 -10l4 4l-10 10h-4" />
                                    <path d="M14 6l4 4" />
                                    <path d="M14 6l4 4L21 7L17 3Z" fill="currentColor" fill-opacity="0.3" />
                                </svg>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.achievements.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this achievement?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 20h5c0.5 0 1 -0.5 1 -1v-14M12 20h-5c-0.5 0 -1 -0.5 -1 -1v-14" />
                                        <path d="M4 5h16" />
                                        <path d="M10 4h4M10 9v7M14 9v7" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 py-10">
                <i class="fas fa-trophy text-4xl opacity-40 mb-2"></i>
                <p>No achievements found.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection

