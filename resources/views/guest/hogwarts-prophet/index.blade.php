@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 pt-32 pb-20 opacity-0 translate-y-10 transition-all duration-700 ease-out"
     id="hogwartsProphetContainer">
    {{-- HEADER --}}
    <div class="text-center mb-14">
        <h1 class="text-5xl font-extrabold drop-shadow font-serif opacity-0 translate-y-6 transition-all duration-700 ease-out"
            id="hogwartsProphetTitle">
            The Hogwarts Prophet
        </h1>
        <p class="text-gray-600 mt-3 text-lg italic opacity-0 translate-y-6 transition-all duration-700 ease-out"
           id="hogwartsProphetSubtitle">Daily magical news and achievements from our enchanted halls</p>
        <div class="w-24 h-1 mx-auto mt-4 rounded-full opacity-0 translate-y-6 transition-all duration-700 ease-out"
             style="background: linear-gradient(90deg, #b03535, #3c5e5e, #425d9e);" id="hogwartsProphetLine"></div>
    </div>

    {{-- ARTIKEL UTAMA --}}
    @if ($news->count() > 0)
    @php $first = $news->first(); @endphp
    <article class="relative mb-12 rounded-2xl overflow-hidden shadow-lg group opacity-0 translate-y-6 transition-all duration-700 ease-out"
             id="firstArticle">
        <img src="{{ asset('storage/' . $first->image) }}" 
             alt="{{ $first->title }}" 
             class="w-full h-[350px] md:h-[400px] object-cover group-hover:scale-105 transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-transparent"></div>

        <div class="absolute bottom-6 left-6 text-white max-w-2xl">
            <h2 class="text-2xl md:text-4xl font-semibold mb-2 leading-tight drop-shadow-md font-serif">
                {{ $first->title }}
            </h2>
            <p class="text-gray-200 mb-2 text-base line-clamp-3">{{ Str::limit(strip_tags($first->content), 150) }}</p>
            <div class="text-xs mb-3 opacity-80">
                <span>{{ $first->writer }}</span> • 
                <span>{{ $first->created_at->format('d M Y') }}</span>
            </div>
            <a href="{{ route('guest.hogwarts-prophet.show', $first->id) }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-white font-serif shadow transition hover:scale-105"
               style="background: linear-gradient(90deg, #b03535, #3c5e5e, #425d9e);">
               Read Full Article
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
               </svg>
            </a>
        </div>
    </article>
    @endif

    {{-- LIST ARTIKEL MODERN --}}
    <div class="space-y-10">
        @foreach ($news->skip(1) as $item)
        <article class="flex flex-col md:flex-row bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-100 opacity-0 translate-y-6 transition-all duration-700 ease-out"
                 data-delay="{{ $loop->index * 100 }}">
            {{-- Gambar --}}
            <div class="md:w-1/3 h-60 md:h-auto overflow-hidden relative">
                @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}"
                         class="absolute inset-0 w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                @else
                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-tr from-red-600 via-teal-600 to-blue-700 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Konten --}}
            <div class="p-8 flex flex-col justify-between md:w-2/3">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3 hover:underline decoration-2 decoration-gradient-to-r decoration-from-red-600 decoration-via-teal-600 decoration-to-blue-700 transition duration-300">
                        {{ $item->title }}
                    </h2>
                    <p class="text-gray-600 text-base mb-4 leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($item->content), 220) }}
                    </p>
                </div>
                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                    <div>
                        {{ $item->writer }} • {{ $item->created_at->format('d M Y') }}
                    </div>
                    <a href="{{ route('guest.hogwarts-prophet.show', $item->id) }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-white font-serif shadow transition hover:scale-105"
                        style="background: linear-gradient(90deg, #b03535, #3c5e5e, #425d9e);">
                       Read More
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                       </svg>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animate container
    const container = document.getElementById('hogwartsProphetContainer');
    container.classList.remove('opacity-0', 'translate-y-10');

    // Animate header
    const title = document.getElementById('hogwartsProphetTitle');
    const subtitle = document.getElementById('hogwartsProphetSubtitle');
    const line = document.getElementById('hogwartsProphetLine');
    setTimeout(() => {
        title.classList.remove('opacity-0', 'translate-y-6');
        subtitle.classList.remove('opacity-0', 'translate-y-6');
        line.classList.remove('opacity-0', 'translate-y-6');
    }, 200);

    // Animate articles sequentially
    const articles = document.querySelectorAll('[data-delay]');
    articles.forEach((article, index) => {
        setTimeout(() => {
            article.classList.remove('opacity-0', 'translate-y-6');
        }, 300 + index * 150);
    });

    // Animate first article
    const firstArticle = document.getElementById('firstArticle');
    if(firstArticle) {
        setTimeout(() => {
            firstArticle.classList.remove('opacity-0', 'translate-y-6');
        }, 200);
    }
});
</script>
@endsection
