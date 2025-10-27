@extends('layouts.app')

@section('content')
<div class="relative max-w-7xl mx-auto px-6 pt-32 pb-12 lg:pr-96">
    <div class="max-w-3xl bg-white rounded-xl shadow-lg p-8 lg:mx-0 mx-auto">
        {{-- Image --}}
        @if (!empty($hogwartsProphet->image) && file_exists(public_path('storage/' . $hogwartsProphet->image)))
            <img src="{{ asset('storage/' . $hogwartsProphet->image) }}" 
                 class="w-full h-64 object-cover rounded-lg mb-6" alt="{{ $hogwartsProphet->title }}">
        @endif

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-amber-800 mb-2">{{ $hogwartsProphet->title }}</h1>
        <p class="text-sm text-gray-500 mb-6">
            {{ $hogwartsProphet->writer }} • {{ $hogwartsProphet->created_at->format('d M Y') }}
        </p>

        {{-- Content --}}
        <div class="text-gray-700 leading-relaxed">
            {!! nl2br(e($hogwartsProphet->content)) !!}
        </div>

        {{-- Share --}}
        <div class="mt-6 flex space-x-4">
        
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Share on Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">
                Share on Twitter
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Share on WhatsApp
            </a>
            <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}')" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Copy Link
            </button>
        </div>

        {{-- LIKE BUTTON --}}
        <div class="mt-8 pt-6 border-t">
            @auth('web')
            <button id="likeButton" 
                    class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 hover:scale-105"
                    data-article-id="{{ $hogwartsProphet->id }}">
                <svg id="likeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span id="likeCount" class="font-semibold">0</span>
                <span class="text-sm text-gray-600">Likes</span>
            </button>
            @else
            <div class="flex items-center justify-between bg-amber-50 border border-amber-200 text-amber-800 rounded-lg px-4 py-3">
                <span class="text-sm">Login untuk menyukai artikel ini.</span>
                <a href="{{ route('user.login') }}" class="text-amber-700 font-semibold hover:underline">Login</a>
            </div>
            @endauth
        </div>

        {{-- COMMENTS SECTION --}}
        <div class="mt-8 pt-6 border-t">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Comments</h3>
            
            {{-- Comment Form --}}
            @auth('web')
            <form id="commentForm" class="mb-6">
                <input type="text" name="website" class="hidden" autocomplete="off">
                <div class="mb-3">
                    <textarea id="commentContent" 
                              name="content" 
                              rows="4" 
                              placeholder="Write a comment..." 
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"></textarea>
                </div>
                <button type="submit" 
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                    Post Comment
                </button>
            </form>
            @else
            <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-4 mb-6">
                <p class="text-sm">Login untuk menulis komentar. <a href="{{ route('user.login') }}" class="font-semibold underline">Login sekarang</a>.</p>
            </div>
            @endauth

            {{-- Comments List --}}
            <div id="commentsList" class="space-y-4">
                <!-- Comments will be loaded here -->
            </div>
    </div>

    <aside class="hidden lg:block absolute right-6 top-0 w-80">
        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-28">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-1.5 h-6 bg-rose-600 rounded"></div>
                <h3 class="text-xl font-extrabold text-sky-700">Terpopuler</h3>
            </div>
            <div>
                @forelse($otherArticles as $item)
                    <a href="{{ route('guest.hogwarts-prophet.show', $item->id) }}" class="block py-3 group border-b last:border-0">
                        <div class="flex gap-3 items-start">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-sky-100 text-sky-700 text-sm font-bold">
                                {{ $loop->iteration }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-800 leading-snug line-clamp-2 group-hover:text-sky-700">{{ $item->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">Belum ada artikel lain.</p>
                @endforelse
            </div>
        </div>
    </aside>
</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const articleId = {{ $hogwartsProphet->id }};
    const likeButton = document.getElementById('likeButton');
    const likeIcon = document.getElementById('likeIcon');
    const likeCount = document.getElementById('likeCount');
    const commentForm = document.getElementById('commentForm');
    const commentsList = document.getElementById('commentsList');

    // Load initial data
    if (likeButton && likeCount && likeIcon) {
        loadLikeStatus();
    }
    loadComments();

    // === LIKE FUNCTIONALITY ===
    function loadLikeStatus() {
        fetch(`/guest/hogwarts-prophet/${articleId}/like-status`)
            .then(res => res.json())
            .then(data => {
                updateLikeButton(data.liked, data.like_count);
            })
            .catch(err => console.error('Failed to load like status:', err));
    }

    function updateLikeButton(liked, count) {
        if (!likeButton || !likeIcon || !likeCount) return;
        likeCount.textContent = count;
        if (liked) {
            likeButton.classList.add('bg-red-100', 'text-red-600');
            likeButton.classList.remove('bg-gray-100', 'text-gray-600');
            likeIcon.setAttribute('fill', 'currentColor');
        } else {
            likeButton.classList.add('bg-gray-100', 'text-gray-600');
            likeButton.classList.remove('bg-red-100', 'text-red-600');
            likeIcon.setAttribute('fill', 'none');
        }
    }

    if (likeButton) {
        likeButton.addEventListener('click', function() {
            fetch(`/guest/hogwarts-prophet/${articleId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateLikeButton(data.liked, data.like_count);
                }
            })
            .catch(err => console.error('Like failed:', err));
        });
    }

    // === COMMENT FUNCTIONALITY ===
    function loadComments() {
        fetch(`/guest/hogwarts-prophet/${articleId}/comments`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    renderComments(data.comments);
                }
            })
            .catch(err => console.error('Failed to load comments:', err));
    }

    function renderComments(comments) {
        if (comments.length === 0) {
            commentsList.innerHTML = '<p class="text-gray-500 text-sm">No comments yet. Be the first to comment!</p>';
            return;
        }

        commentsList.innerHTML = comments.map(comment => `
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-2">
                    <span class="font-semibold text-gray-800">${escapeHtml(comment.name || 'Anonymous')}</span>
                    <span class="text-xs text-gray-500">${formatDate(comment.created_at)}</span>
                </div>
                <p class="text-gray-700">${escapeHtml(comment.content)}</p>
            </div>
        `).join('');
    }

    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(commentForm);
            const data = {
                content: formData.get('content'),
                website: formData.get('website')
            };

            fetch(`/guest/hogwarts-prophet/${articleId}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    commentForm.reset();
                    loadComments();
                    alert('Comment posted successfully!');
                } else {
                    alert(data.message || 'Failed to post comment');
                }
            })
            .catch(err => {
                console.error('Comment failed:', err);
                alert('Failed to post comment');
            });
        });
    }

    // === HELPER FUNCTIONS ===
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);

        if (diffMins < 1) return 'Just now';
        if (diffMins < 60) return `${diffMins}m ago`;
        if (diffHours < 24) return `${diffHours}h ago`;
        if (diffDays < 7) return `${diffDays}d ago`;
        return date.toLocaleDateString();
    }
});
</script>
@endsection
