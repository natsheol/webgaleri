@extends('layouts.manage')

@section('title', 'Founders')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">School Founders</h1>
            <p class="text-gray-600">Manage the founders of Hogwarts School</p>
        </div>
        <a href="{{ route('admin.school-profile.founders.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Add Founder
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($founders->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($founders as $founder)
                <div class="bg-gray-50 rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4 mb-4">
                        @if($founder->photo)
                            <img src="{{ asset('storage/' . $founder->photo) }}" 
                                 alt="{{ $founder->name }}" 
                                 class="h-16 w-16 rounded-full object-cover border-2 border-gray-300">
                        @else
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $founder->name }}</h3>
                            <p class="text-sm text-gray-500">Born {{ $founder->birth_year }}</p>
                        </div>
                    </div>
                    
                    @if($founder->description)
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($founder->description, 100) }}</p>
                    @endif

                    <div class="flex space-x-2">
                        <a href="{{ route('admin.school-profile.founders.edit', $founder->id) }}" 
                           class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.school-profile.founders.destroy', $founder->id) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this founder?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-users text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-500 mb-2">No founders added yet</h3>
            <p class="text-gray-400 mb-6">Start by adding the founders of Hogwarts School</p>
            <a href="{{ route('admin.school-profile.founders.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Add First Founder
            </a>
        </div>
    @endif
</div>
@endsection