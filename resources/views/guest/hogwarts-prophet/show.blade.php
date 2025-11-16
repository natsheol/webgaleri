@extends('layouts.app')

@section('content')

<div class="relative max-w-7xl mx-auto px-6 pt-32 pb-12 lg:flex lg:gap-8">
    
               
                <a href="{{ route('guest.hogwarts-prophet.index') }}" class="text-xl font-serif font-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l6 6m-6-6l6-6" />
                </svg></a>

    {{-- Main Content --}}
    <div class="flex-1 bg-white rounded-xl shadow-lg p-8 flex flex-col gap-6">
        
        {{-- Image --}}
        @if (!empty($hogwartsProphet->image) && file_exists(public_path('storage/' . $hogwartsProphet->image)))
            <img src="{{ asset('storage/' . $hogwartsProphet->image) }}" 
                 class="w-full h-64 object-cover rounded-xl shadow-md mb-4" 
                 alt="{{ $hogwartsProphet->title }}">
        @endif

        {{-- Title --}}
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-bold font-serif">{{ $hogwartsProphet->title }}</h1>
            <p class="text-sm text-gray-500">{{ $hogwartsProphet->writer }} • {{ $hogwartsProphet->created_at->format('d M Y') }}</p>
        </div>

        {{-- Content --}}
        <div class="text-gray-700 leading-relaxed">
            {!! nl2br(e($hogwartsProphet->content)) !!}
        </div>

        {{-- Share --}}
        <div class="flex flex-wrap gap-3 mt-4">

            <a href="https://instagram.com/stories/create?url=${url}={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-800 transition">
                        <path fill="currentColor" d="M8 3C5.239 3 3 5.239 3 8v8c0 2.761 2.239 5 5 5h8c2.761 0 5-2.239 5-5V8c0-2.761-2.239-5-5-5H8zm10 2c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm-6 2c2.761 0 5 2.239 5 5s-2.239 5-5 5-5-2.239-5-5 2.239-5 5-5zm0 2a3 3 0 100 6 3 3 0 000-6z"/>
                </svg>
            </a>

            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                target="_blank" 
                class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-800  transition">
                        <path fill="currentColor" d="M12,2C6.477,2,2,6.477,2,12c0,5.013,3.693,9.153,8.505,9.876V14.65H8.031v-2.629h2.474v-1.749 c0-2.896,1.411-4.167,3.818-4.167c1.153,0,1.762,0.085,2.051,0.124v2.294h-1.642c-1.022,0-1.379,0.969-1.379,2.061v1.437h2.995 l-0.406,2.629h-2.588v7.247C18.235,21.236,22,17.062,22,12C22,6.477,17.523,2,12,2z"/>
                </svg>
            </a>

            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-800  transition">
                        <path fill="currentColor" d="M11 4C7.134 4 4 7.134 4 11v28c0 3.866 3.134 7 7 7h28c3.866 0 7-3.134 7-7V11c0-3.866-3.134-7-7-7H11zm2.086 9L31.02 35h3.066L19.978 15h-2.064zm-3.914 0l9.223 13.897L15.5 37h-2l8.308-10.897L9.172 13h2z"/>
                </svg>
            </a>

            <a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-800 transition">
                        <path fill="currentColor" d="M19.077,4.928C17.191,3.041,14.683,2.001,12.011,2c-5.506,0-9.987,4.479-9.989,9.985 c-0.001,1.76,0.459,3.478,1.333,4.992L2,22l5.233-1.237c1.459,0.796,3.101,1.215,4.773,1.216h0.004 c5.505,0,9.986-4.48,9.989-9.985C22.001,9.325,20.963,6.816,19.077,4.928z M16.898,15.554c-0.208,0.583-1.227,1.145-1.685,1.186 c-0.458,0.042-0.887,0.207-2.995-0.624c-2.537-1-4.139-3.601-4.263-3.767c-0.125-0.167-1.019-1.353-1.019-2.581 S7.581,7.936,7.81,7.687c0.229-0.25,0.499-0.312,0.666-0.312c0.166,0,0.333,0,0.478,0.006c0.178,0.007,0.375,0.016,0.562,0.431 c0.222,0.494,0.707,1.728,0.769,1.853s0.104,0.271,0.021,0.437s-0.125,0.27-0.249,0.416c-0.125,0.146-0.262,0.325-0.374,0.437 c-0.125,0.124-0.255,0.26-0.11,0.509c0.146,0.25,0.646,1.067,1.388,1.728c0.954,0.85,1.757,1.113,2.007,1.239 c0.25,0.125,0.395,0.104,0.541-0.063c0.146-0.166,0.624-0.728,0.79-0.978s0.333-0.208,0.562-0.125s1.456,0.687,1.705,0.812 c0.25,0.125,0.416,0.187,0.478,0.291C17.106,14.471,17.106,14.971,16.898,15.554z"/>
                </svg>
            </a>

            <!-- <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:scale-105 transition text-sm">
                Copy Link
            </button> -->

        </div>

        {{-- Like --}}
        <div class="mt-6 border-t pt-6">
            <button id="likeButton" class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 hover:scale-105">
                <svg id="likeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364
                             l7.682-7.682a4.5 4.5 0 00-6.364-6.364
                             L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span id="likeCount" class="font-semibold">0</span>
                <span class="text-sm text-gray-600">Likes</span>
            </button>
        </div>

        {{-- Comments --}}
        <div class="mt-6 border-t pt-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 font-serif">Comments</h3>

            <form id="commentForm" class=" gap-3 mb-6">
                <input type="hidden" name="redirect" value="{{ request()->fullUrl() }}">
                <textarea id="commentContent" name="content" rows="4" placeholder="Write a comment..." required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"></textarea>
                <button type="submit" 
                        class="mt-3 overflow-hidden group inline-block px-6 py-2 font-serif rounded-lg
                        text-white tracking-wide shadow-md hover:shadow-lg transition-all duration-300
                        hover:scale-105"
                        style="
                            background: linear-gradient(90deg, #b03535 0%, #3c5e5e 50%, #425d9e 100%);
                            background-clip: padding-box;
                        ">
                    Post Comment
                </button>
            </form>

            <div id="commentsList" class="flex flex-col gap-4"></div>
        </div>
    </div>

    {{-- Sidebar Terpopuler --}}
    <aside class="w-72 hidden lg:block">
        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-28 flex flex-col gap-4">
            {{-- Header --}}
            <div class="flex items-center gap-2 mb-4">
                <div class="w-1.5 h-6 rounded-full font-serif" style="
                    background: linear-gradient(180deg, #b03535 0%, #3c5e5e 50%, #425d9e 100%);
                    display: inline-block;
                    vertical-align: middle;
                    font-weight: 400;"></div>
                <h3 class="text-xl font-serif font-semibold">Terpopuler</h3>
            </div>

            {{-- List Artikel --}}
            <div class="flex flex-col gap-3">
                @forelse($otherArticles->take(3) as $item)
                    <a href="{{ route('guest.hogwarts-prophet.show', $item->id) }}" 
                        class="flex items-start gap-3 p-2 rounded-lg hover:bg-sky-50 transition">
                        {{-- Nomor --}}
                        <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-sky-100 text-sky-700 font-serif font-semibold text-sm">
                            {{ $loop->iteration }}
                        </div>
                        {{-- Judul & Tanggal --}}
                        <div class="min-w-0">
                            <p class="font-semibold font-serif text-gray-800 leading-snug line-clamp-2 hover:text-sky-700 transition">
                                {{ $item->title }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">Another articles not found</p>
                @endforelse
            </div>
        </div>
    </aside>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
    const articleId = {{ $hogwartsProphet->id }};
    const likeBtn = document.getElementById('likeButton');
    const likeCount = document.getElementById('likeCount');
    const likeIcon = document.getElementById('likeIcon');
    const commentForm = document.getElementById('commentForm');
    const commentsList = document.getElementById('commentsList');

    loadLikeStatus();
    loadComments();

    // ====== LIKE ======
    likeBtn.addEventListener('click', async () => {
        const res = await fetch(`/guest/hogwarts-prophet/${articleId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await res.json();

        if (data.redirect) {
            window.location.href = data.redirect;
            return;
        }

        if (data.success) {
            updateLikeButton(data.liked, data.like_count);
        }
    });

    function updateLikeButton(liked, count) {
        likeCount.textContent = count;
        likeIcon.setAttribute('fill', liked ? 'currentColor' : 'none');
        likeBtn.classList.toggle('text-red-600', liked);
        likeBtn.classList.toggle('text-gray-600', !liked);
    }

    async function loadLikeStatus() {
        const res = await fetch(`/guest/hogwarts-prophet/${articleId}/like-status`);
        const data = await res.json();
        if (data.success) updateLikeButton(data.liked, data.like_count);
    }

    // ====== COMMENTS ======
    commentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const content = document.getElementById('commentContent').value.trim();
        if (!content) return;

        const formData = new FormData();
        formData.append('content', content);

        const res = await fetch(`/guest/hogwarts-prophet/${articleId}/comments`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });


        const data = await res.json();

        if (data.redirect) {
            window.location.href = data.redirect;
            return;
        }

        if (data.success) {
            commentForm.reset();
            loadComments();
        }
    });

    async function loadComments() {
        const res = await fetch(`/guest/hogwarts-prophet/${articleId}/comments`);
        const data = await res.json();

        if (data.success && data.comments.length > 0) {
            commentsList.innerHTML = data.comments.map(c => `
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between mb-1">
                        <span class="font-semibold text-gray-800">${c.user?.name ?? 'Anonymous'}</span>
                        <span class="text-xs text-gray-500">${new Date(c.created_at).toLocaleString()}</span>
                    </div>
                    <p class="text-gray-700">${c.content}</p>
                </div>
            `).join('');
        } else {
            commentsList.innerHTML = `<p class="text-gray-500 text-sm">No comments yet.</p>`;
        }
    }
});
</script>

@endsection
