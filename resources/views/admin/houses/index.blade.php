@extends('layouts.manage')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Houses</h1>
    </div>

    <!-- Success message -->
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
      </div>
    @endif

    <!-- Houses list -->
    <div class="grid gap-4">
        @foreach($houses as $house)
        <div class="p-4 bg-white rounded-lg shadow flex items-center gap-4">
            <!-- House logo -->
            <img src="{{ $house->logo ? asset('storage/'.$house->logo) : asset('images/icons/default.png') }}" 
                 class="w-16 h-16 rounded">

            <!-- House info -->
            <div class="flex-1">
                <h3 class="font-semibold">{{ $house->name }}</h3>
                <p class="text-sm text-gray-500">
                    {{ Str::limit($house->legacy ?? $house->description ?? '-', 100) }}
                </p>
                @if($house->characteristics)
                <p class="text-sm text-gray-600 mt-1">
                    <strong>Characteristics:</strong> {{ implode(', ', $house->characteristics) }}
                </p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex gap-2">
                <a href="{{ route('admin.houses.edit', $house->id) }}" 
                   class="px-3 py-1 bg-amber-700 text-white rounded-lg hover:bg-amber-900">
                   Choose
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
