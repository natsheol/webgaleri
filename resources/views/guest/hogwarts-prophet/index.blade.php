@extends('layouts.app')

@section('content')
{{-- Container utama --}}
<div class="container mx-auto px-6 pt-32 pb-12">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-amber-800 drop-shadow-lg">Hogwarts Prophet</h1>
        <p class="text-gray-600 mt-2">Latest magical news and achievements from Hogwarts</p>
    </div>

    {{-- Grid Berita --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($news as $item)
            <article 
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl hover:scale-105 transform transition-all duration-300 group cursor-pointer"
                onclick="openModal('{{ addslashes($item->title) }}', '{{ addslashes($item->writer) }}', '{{ $item->created_at->format('d M Y') }}', '{{ addslashes(asset('storage/' . $item->image)) }}', `{{ addslashes($item->content) }}`)">
                
                {{-- Image --}}
                <div class="h-48 bg-gradient-to-r from-amber-600 to-amber-800 relative overflow-hidden">
                    @if (!empty($item->image) && file_exists(public_path('storage/' . $item->image)))
                        <img src="{{ asset('storage/' . $item->image) }}" 
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                            alt="{{ $item->title }}">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-scroll text-white text-6xl opacity-30"></i>
                        </div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-amber-700 transition-colors duration-300">
                        {{ $item->title }}
                    </h2>
                    <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($item->content, 120) }}</p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span>{{ $item->writer }}</span> • 
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-center col-span-full text-gray-500">No news available.</p>
        @endforelse
    </div>
</div>

{{-- Modal Overlay --}}
<div id="newsModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl w-[80%] md:w-3/4 lg:w-2/3 h-[80%] overflow-y-auto relative p-6">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-64 object-cover rounded-lg mb-4" alt="News Image">
        <h2 id="modalTitle" class="text-2xl font-bold text-amber-800 mb-2"></h2>
        <p id="modalMeta" class="text-sm text-gray-500 mb-4"></p>
        <div id="modalContent" class="text-gray-700 leading-relaxed"></div>
    </div>
</div>

{{-- Script Modal --}}
<script>
function openModal(title, writer, date, image, content) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalMeta').innerText = `${writer} • ${date}`;
    document.getElementById('modalImage').src = image;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('newsModal').classList.remove('hidden');
    document.getElementById('newsModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('newsModal').classList.add('hidden');
    document.getElementById('newsModal').classList.remove('flex');
}
</script>
@endsection
