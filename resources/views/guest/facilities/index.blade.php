@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center mb-8">Our Facilities</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('guest.facilities.show', $category->slug) }}" 
               class="block rounded-xl overflow-hidden shadow hover:shadow-lg transition">

                @php $photo = $category->coverPhoto?->image; @endphp

                @if($photo && \Storage::disk('public')->exists($photo))
                    <img src="{{ asset('storage/' . $photo) }}" 
                         class="w-full h-48 object-cover" 
                         alt="{{ $category->name }}">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gray-200 text-gray-500">
                        No Image
                    </div>
                @endif

                <div class="p-4 bg-white">
                    <h2 class="text-xl font-semibold text-center">{{ $category->name }}</h2>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
