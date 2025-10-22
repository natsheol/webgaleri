@extends('layouts.guest')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $house->name }}</h1>
    <img src="{{ asset('storage/' . $house->logo) }}" class="w-32 h-32 mb-6 object-contain">
    <p class="text-gray-700">{{ $house->description ?? 'No description available.' }}</p>
</div>
@endsection
