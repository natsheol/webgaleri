@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Add New Category</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-4 mb-6 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.facilities.categories.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="border rounded w-full p-2" required>
        </div>

        <div>
            <label class="block font-medium">Slug</label>
            <input type="text" name="slug" class="border rounded w-full p-2" required>
        </div>

        <div>
            <label class="block font-medium">Sort Order</label>
            <input type="number" name="sort_order" class="border rounded w-full p-2">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked>
            <label for="is_active">Active</label>
        </div>

        <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800">Save Category</button>
    </form>
</div>
@endsection
