@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold mb-6 text-amber-800">{{ $category->name }}</h1>
    <p class="text-gray-600 mb-8">{{ $category->description ?? '' }}</p>

    @if($category->photos && $category->photos->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($category->photos as $photo)
                <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $photo->image) }}" 
                         alt="{{ $photo->name }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-semibold text-gray-800">{{ $photo->name }}</h2>
                        <p class="text-gray-500 text-sm">{{ $photo->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No photos available for this category.</p>
    @endif

    <div class="mt-8">
        <a href="{{ route('facilities.index') }}" 
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
           Back to Facilities
        </a>
    </div>
</div>
@endsection
