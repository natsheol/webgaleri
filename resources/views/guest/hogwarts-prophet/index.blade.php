@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-20">
    {{-- HEADER --}}
    <div class="text-center mb-14">
        <h1 class="text-5xl font-extrabold text-amber-800 drop-shadow font-serif">The Hogwarts Prophet</h1>
        <p class="text-gray-600 mt-3 text-lg italic">Daily magical news and achievements from our enchanted halls</p>
        <div class="w-24 h-1 bg-amber-600 mx-auto mt-4 rounded-full"></div>
    </div>

    {{-- ARTIKEL UTAMA --}}
    @if ($news->count() > 0)
    @php $first = $news->first(); @endphp
    <article class="relative mb-16 rounded-3xl overflow-hidden shadow-xl group">
        <img src="{{ asset('storage/' . $first->image) }}" 
             alt="{{ $first->title }}" 
             class="w-full h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

        <div class="absolute bottom-10 left-10 text-white max-w-3xl">
            <h2 class="text-5xl font-bold mb-4 leading-tight drop-shadow-md">{{ $first->title }}</h2>
            <p class="text-gray-200 mb-4 text-lg line-clamp-3">{{ Str::limit(strip_tags($first->content), 200) }}</p>
            <div class="text-sm mb-5 opacity-80">
                <span>{{ $first->writer }}</span> • 
                <span>{{ $first->created_at->format('d M Y') }}</span>
            </div>
            <a href="{{ route('guest.hogwarts-prophet.show', $first->id) }}" 
               class="inline-block bg-amber-700 hover:bg-amber-800 px-6 py-3 rounded-lg text-white font-semibold shadow-md transition">
               Read Full Article →
            </a>
        </div>
    </article>
    @endif

    {{-- DAFTAR ARTIKEL PERSEGI PANJANG (MODERN LAYOUT) --}}
    <div class="space-y-10">
        @foreach ($news->skip(1) as $item)
        <article class="flex flex-col md:flex-row bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden border border-amber-100">
            {{-- Gambar --}}
            <div class="md:w-1/3 h-60 md:h-auto overflow-hidden relative">
                @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}"
                         class="absolute inset-0 w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                @else
                    <div class="absolute inset-0 flex items-center justify-center bg-amber-700 text-white">
                        <i class="fas fa-scroll text-6xl opacity-40"></i>
                    </div>
                @endif
            </div>

            {{-- Konten --}}
            <div class="p-8 flex flex-col justify-between md:w-2/3">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3 hover:text-amber-700 transition-colors duration-300">
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
                       class="text-amber-700 hover:text-amber-900 font-semibold">
                       Read More →
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>

{{-- ==============================
     MODAL QUICK VIEW (OPTIONAL)
============================== --}}
<div id="newsModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl h-[85vh] overflow-y-auto relative p-8">
        <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
        <img id="modalImage" class="w-full h-72 object-cover rounded-lg mb-6" alt="News Image">
        <h2 id="modalTitle" class="text-3xl font-bold text-amber-800 mb-2 leading-tight"></h2>
        <p id="modalMeta" class="text-sm text-gray-500 mb-5"></p>
        <div id="modalContent" class="text-gray-700 leading-relaxed text-justify"></div>
    </div>
</div>

<script>
function openModal(title, writer, date, image, content) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalMeta').innerText = `${writer} • ${date}`;
    document.getElementById('modalImage').src = image;
    document.getElementById('modalContent').innerHTML = content;
    const modal = document.getElementById('newsModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    const modal = document.getElementById('newsModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}
</script>
@endsection
