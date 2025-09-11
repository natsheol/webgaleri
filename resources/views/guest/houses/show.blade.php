@extends('layouts.app')

@section('content')
<section class="bg-gray-900 py-16">
    <div class="max-w-5xl mx-auto px-6 text-white">
        <h1 class="text-4xl font-bold mb-6">{{ $house->name }}</h1>
        
        <div class="w-32 h-1 mb-6" style="background: {{ $house->color_secondary ?? '#f59e0b' }}"></div>

        <p class="mb-6">{{ $house->description ?? 'No description available.' }}</p>

        <ul class="space-y-2 mb-6">
            <li><strong>Founder:</strong> {{ $house->founder ?? '-' }}</li>
            <li><strong>Students Count:</strong> {{ $house->students_count ?? 0 }}</li>
        </ul>

        <a href="{{ route('houses.index') }}" 
           class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-full">
           ← Back to Houses
        </a>
    </div>
</section>
@endsection
