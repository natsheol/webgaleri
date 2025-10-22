@extends('layouts.app')

@section('title', 'Houses - Hogwarts')

@section('content')
<section class="min-h-screen bg-gray-100 pt-24 pb-12 px-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Hogwarts Houses</h1>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($houses as $house)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $house->crest) }}" 
                         alt="{{ $house->name }}" 
                         class="w-full h-40 object-contain bg-gray-50">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $house->name }}</h2>
                        <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ $house->description }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">No houses available yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
