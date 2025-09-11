@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold mb-8 text-center text-amber-800">Facilities</h1>

    @forelse($categories as $category)
        <div class="mb-8 border rounded-lg p-6 bg-white shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-2">{{ $category->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $category->description ?? '' }}</p>
            <a href="{{ route('facilities.show', $category->slug) }}" 
               class="px-4 py-2 bg-amber-700 text-white rounded shadow hover:bg-amber-900">
               View Photos
            </a>
        </div>
    @empty
        <p class="text-center text-gray-500">No facility categories available.</p>
    @endforelse
</div>
@endsection
