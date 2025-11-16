@extends('layouts.manage')

@section('title', 'Houses')

@php
    $links = [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => 'Houses', 'route' => null],
    ];
@endphp

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
            Hogwarts Houses
        </h1>
        <p class="text-gray-500 mt-2">Select and manage the noble Houses of Hogwarts</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 border border-green-300 text-green-800 rounded-xl shadow-sm flex items-center gap-2">
          <i class="fas fa-check-circle text-green-600"></i>
          <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Houses Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($houses as $house)
        <div class="group bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden 
                    hover:shadow-md hover:scale-[1.02] transition-all duration-300 p-6 flex gap-6 items-center">

            {{-- House Logo --}}
            <div class="flex-shrink-0 w-24 h-24 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                <img src="{{ $house->logo ? asset('storage/'.$house->logo) : asset('images/icons/default.png') }}" 
                     class="w-full h-full object-cover" alt="{{ $house->name }}">
            </div>

            {{-- Info --}}
            <div class="flex flex-col flex-1">
                <h3 class="text-xl font-semibold text-gray-800">{{ $house->name }}</h3>
                <p class="text-sm text-gray-600 mt-1">
                    {{ Str::limit($house->legacy ?? $house->description ?? '-', 120) }}
                </p>

                @if($house->characteristics)
                    <p class="text-xs text-gray-500 mt-2">
                        <span class="font-medium">Traits:</span>
                        {{ implode(', ', $house->characteristics) }}
                    </p>
                @endif
            </div>

            {{-- Action Button --}}
            <div>
                <a href="{{ route('admin.houses.edit', $house->id) }}" 
                   class="inline-block px-5 py-2 rounded-xl text-white font-medium shadow-sm 
                          bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] 
                          hover:opacity-90 transition">
                   Choose
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
