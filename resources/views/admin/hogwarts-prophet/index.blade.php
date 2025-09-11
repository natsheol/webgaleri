@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- Header dengan judul + search form + tombol add --}}
    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800 flex-shrink-0">
            Hogwarts Prophet
        </h1>

        <div class="flex items-center gap-2 flex-grow justify-end">
            <form method="GET" action="{{ route('admin.hogwarts-prophet.index') }}" class="flex gap-2 max-w-2xl w-full">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title or writer..."
                    autocomplete="off"
                    class="flex-grow h-10 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
                <button type="submit" 
                        class="h-10 px-4 border border-amber-700 text-amber-700 rounded-lg hover:bg-amber-50 transition-shadow shadow-sm text-sm">
                    Search
                </button>
            </form>

            <a href="{{ route('admin.hogwarts-prophet.create') }}"
            class="h-10 px-4 bg-amber-700 hover:bg-amber-900 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center">
                + New Article
            </a>
        </div>
    </div>






    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Articles list --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse ($news as $item)
            <div class="flex gap-4 bg-white shadow-md rounded-xl overflow-hidden p-4">
                {{-- Image --}}
                <div class="w-40 aspect-[5/3] flex-shrink-0 rounded-lg overflow-hidden bg-gray-200">
                    @if (!empty($item->image) && file_exists(public_path('storage/' . $item->image)))
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover" alt="Thumbnail">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <i class="fas fa-scroll text-4xl opacity-40"></i>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $item->title }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->content, 500) }}</p>
                    </div>

                    <div class="mt-4 text-sm text-gray-500 flex justify-between items-end">
                        <div>
                            <p><span class="font-medium">{{ $item->writer }}</span></p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.hogwarts-prophet.edit', $item->id) }}"
                               class="text-yellow-500 hover:text-yellow-600 flex items-center justify-center align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 21h18" />
                                        <path d="M7 17v-4l10 -10l4 4l-10 10h-4" />
                                        <path d="M14 6l4 4" />
                                        <path d="M14 6l4 4L21 7L17 3Z" fill="currentColor" fill-opacity="0.3" />
                                    </svg>
                            </a>
                            <form action="{{ route('admin.hogwarts-prophet.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this article?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-600 flex items-center justify-center align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 20h5c0.5 0 1 -0.5 1 -1v-14M12 20h-5c-0.5 0 -1 -0.5 -1 -1v-14" />
                                        <path d="M4 5h16" />
                                        <path d="M10 4h4M10 9v7M14 9v7" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600">No articles found.</div>
        @endforelse
    </div>
</div>
@endsection
