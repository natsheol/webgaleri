{{-- Achievements Section --}}
<section id="achievements" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Achievements</h2>
            <div class="w-24 h-1 bg-amber-500 mx-auto mt-4"></div>
            <p class="text-gray-600 mt-4">Proud moments and recognitions from our school community</p>
        </div>

        {{-- Grid Achievements --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($achievements as $achievement)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group"
                     data-id="{{ $achievement->id }}"
                     data-title="{{ $achievement->title }}"
                     data-writer="{{ $achievement->writer ?? 'Admin' }}"
                     data-date="{{ $achievement->date }}"
                     data-description="{{ $achievement->description }}"
                     data-image="{{ $achievement->image ? asset('storage/' . $achievement->image) : '/images/placeholder.jpg' }}">
                    
                    @if($achievement->image)
                        <img src="{{ asset('storage/' . $achievement->image) }}" alt="{{ $achievement->title }}" class="w-full h-48 object-cover">
                    @else
                        <img src="/images/placeholder.jpg" alt="placeholder" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $achievement->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ \Carbon\Carbon::parse($achievement->date)->format('F j, Y') }}
                        </p>
                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit($achievement->description, 80) }}</p>
                        <span class="inline-block px-3 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-full">
                            {{ $achievement->category ?? 'General' }}
                        </span>

                        <div class="mt-4 flex justify-between items-center">
                            <button onclick="openAchievementModal(this)"
                                    class="text-amber-700 hover:underline text-sm font-semibold">
                                Quick View
                            </button>
                            <div class="flex items-center">
                                <span class="mr-2 text-gray-500">👁️</span>
                                <a href="{{ route('guest.achievements.show', $achievement->id) }}"
                                   class="text-sm bg-amber-600 text-white px-3 py-1 rounded-lg hover:bg-amber-700 transition">
                                   Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View More Button --}}
        <div class="mt-12 text-center">
            <a href="{{ route('guest.achievements.index') }}"
               class="inline-block bg-amber-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-amber-600 transition">
                View More
            </a>
        </div>
    </div>
</section>

{{-- Modal Overlay --}}
<div id="achievementModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl w-[90%] md:w-3/4 lg:w-2/3 max-h-[90%] overflow-y-auto relative p-6">
        <button onclick="closeAchievementModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <img id="modalImage" class="w-full h-64 object-cover rounded-lg mb-4" alt="Achievement Image">
        <h2 id="modalTitle" class="text-2xl font-bold text-amber-800 mb-2"></h2>
        <p id="modalMeta" class="text-sm text-gray-500 mb-4"></p>
        <div id="modalContent" class="text-gray-700 leading-relaxed"></div>

        {{-- Share Buttons --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <button onclick="shareOnFacebook()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Share on Facebook
            </button>
            <button onclick="shareOnTwitter()" class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">
                Share on Twitter
            </button>
            <button onclick="copyLink()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Copy Link
            </button>
        </div>
    </div>
</div>

{{-- JS Modal + Share --}}
<script>
let currentAchievementUrl = "";

function openAchievementModal(button) {
    const card = button.closest('[data-id]');
    document.getElementById('modalTitle').innerText = card.dataset.title;
    document.getElementById('modalMeta').innerText = `${card.dataset.writer} • ${new Date(card.dataset.date).toLocaleDateString()}`;
    document.getElementById('modalContent').innerText = card.dataset.description;
    document.getElementById('modalImage').src = card.dataset.image;

    document.getElementById('achievementModal').classList.remove('hidden');
    document.getElementById('achievementModal').classList.add('flex');

    currentAchievementUrl = window.location.origin + `/guest/achievements/${card.dataset.id}`;
}

function closeAchievementModal() {
    document.getElementById('achievementModal').classList.add('hidden');
    document.getElementById('achievementModal').classList.remove('flex');
}

function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentAchievementUrl)}`, "_blank");
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(currentAchievementUrl)}`, "_blank");
}

function copyLink() {
    navigator.clipboard.writeText(currentAchievementUrl);
    alert("Link copied to clipboard!");
}
</script>
