@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pt-32 pb-12">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-amber-800 drop-shadow-lg">Achievements</h1>
        <p class="text-gray-600 mt-2">Latest accomplishments and highlights from our students</p>
    </div>

    {{-- Grid Achievements --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($achievements as $item)
            <article 
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform transition-all duration-300 group">

                {{-- Image --}}
                <div class="h-48 bg-gradient-to-r from-amber-600 to-amber-800 relative overflow-hidden cursor-pointer"
                     onclick="openModal('{{ addslashes($item->title) }}', '{{ addslashes($item->writer ?? 'Admin') }}', '{{ $item->created_at->format('d M Y') }}', '{{ addslashes($item->image ? asset('storage/' . $item->image) : '') }}', `{{ addslashes($item->description) }}`)">
                    @if (!empty($item->image) && file_exists(public_path('storage/' . $item->image)))
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                             alt="{{ $item->title }}">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-trophy text-white text-6xl opacity-30"></i>
                        </div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-amber-700 transition-colors duration-300">
                        {{ $item->title }}
                    </h2>
                    <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($item->description, 120) }}</p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span>{{ $item->writer ?? 'Admin' }}</span> • 
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-4 flex justify-between items-center">
                        <button 
                            class="text-amber-700 hover:underline text-sm font-semibold"
                            onclick="openModal('{{ addslashes($item->title) }}', '{{ addslashes($item->writer ?? 'Admin') }}', '{{ $item->created_at->format('d M Y') }}', '{{ addslashes($item->image ? asset('storage/' . $item->image) : '') }}', `{{ addslashes($item->description) }}`)">
                            Quick View
                        </button>
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-500">👁️</span>
                            <a href="{{ route('guest.achievements.show', $item->id) }}" 
                               class="text-sm bg-amber-600 text-white px-3 py-1 rounded-lg hover:bg-amber-700 transition">
                               Read More
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-center col-span-full text-gray-500">No achievements available.</p>
        @endforelse
    </div>
</div>

{{-- Modal Overlay --}}
<div id="achievementModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl w-[80%] md:w-3/4 lg:w-2/3 h-[80%] overflow-y-auto relative p-6">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-64 object-cover rounded-lg mb-4" alt="Achievement Image">
        <h2 id="modalTitle" class="text-2xl font-bold text-amber-800 mb-2"></h2>
        <p id="modalMeta" class="text-sm text-gray-500 mb-4"></p>
        <div id="modalContent" class="text-gray-700 leading-relaxed"></div>
        
        {{-- Share Buttons --}}
        <div class="mt-6 flex space-x-4">
            <a id="whatsappShare" target="_blank" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">WhatsApp</a>
            <button onclick="shareOnFacebook()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Facebook</button>
            <button onclick="shareOnTwitter()" class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">Twitter</button>
            <button onclick="copyLink()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Copy Link</button>
        </div>
    </div>
</div>

<script>
let currentUrl = "";

function openModal(title, writer, date, image, content) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalMeta').innerText = `${writer} • ${date}`;
    document.getElementById('modalImage').src = image || '';
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('achievementModal').classList.remove('hidden');
    document.getElementById('achievementModal').classList.add('flex');
    
    currentUrl = window.location.origin + "/guest/achievements"; // bisa diganti slug jika ada
    document.getElementById('whatsappShare').href = `https://api.whatsapp.com/send?text=${encodeURIComponent(currentUrl)}`;
}

function closeModal() {
    document.getElementById('achievementModal').classList.add('hidden');
    document.getElementById('achievementModal').classList.remove('flex');
}

function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`, "_blank");
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl)}`, "_blank");
}

function copyLink() {
    navigator.clipboard.writeText(currentUrl);
    alert("Link copied to clipboard!");
}
</script>
@endsection
