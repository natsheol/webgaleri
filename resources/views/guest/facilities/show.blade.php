@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center mb-6">{{ $category->name }}</h1>

    @if($category->description)
        <p class="text-center text-gray-700 max-w-2xl mx-auto mb-8">
            {{ $category->description }}
        </p>
    @endif

    {{-- GRID FOTO --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($category->photos as $photo)
            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl bg-white/80 backdrop-blur-sm transition duration-300"
                 data-photo-id="{{ $photo->id }}">
                <div class="relative">
                    <img src="{{ asset('storage/'.$photo->image) }}"
                         alt="{{ $photo->caption ?? $photo->name }}"
                         class="w-full h-56 object-cover cursor-pointer photo-view-trigger rounded-t-lg"
                         data-photo-id="{{ $photo->id }}"
                         data-photo-index="{{ $loop->index }}"
                         data-photo-name="{{ $photo->name }}"
                         data-photo-desc="{{ $photo->description ?? '' }}">
                </div>

                <div class="p-3">
                    <h3 class="font-semibold text-gray-800 text-base truncate">{{ $photo->name }}</h3>
                    @if($photo->description)
                        <p class="text-xs text-gray-600 mt-1 truncate">{{ $photo->description }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No photos available.</p>
        @endforelse
    </div>

    {{-- Tombol Back --}}
    <div class="mt-8 text-center">
        <a href="{{ route('guest.facilities.index') }}"
           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ← Back to Facilities
        </a>
    </div>
</div>

{{-- =======================
     MODAL / CAROUSEL VIEWER
======================= --}}
<div id="photoModal"
     class="fixed inset-0 bg-black/90 backdrop-blur-sm hidden z-50 overflow-y-auto transition-all duration-300">
    
    <div class="min-h-screen flex items-start justify-center py-8 px-4">
        <div class="w-full max-w-6xl relative">
            {{-- Tombol Close --}}
            <button id="closeModal"
                    class="absolute top-2 right-2 z-10 text-white text-4xl font-bold hover:text-gray-300 transition transform hover:scale-110">
                &times;
            </button>

            {{-- Navigasi --}}
            <button id="prevPhoto"
                    class="absolute left-2 top-1/3 z-10 text-white text-5xl opacity-40 hover:opacity-100 transition transform hover:scale-125 select-none">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>

            <button id="nextPhoto"
                    class="absolute right-2 top-1/3 z-10 text-white text-5xl opacity-40 hover:opacity-100 transition transform hover:scale-125 select-none">
                <span class="material-symbols-rounded">chevron_right</span>
            </button>

            {{-- FOTO --}}
            <div class="flex items-center justify-center mb-4">
                <img id="modalImage"
                     src=""
                     class="max-h-[60vh] max-w-full object-contain rounded-2xl shadow-2xl">
            </div>

            {{-- CAPTION & INTERACTIONS --}}
            <div class="bg-white/95 backdrop-blur rounded-2xl p-6 shadow-2xl">
                <div id="photoCaption" class="mb-4">
                    <h3 id="photoName" class="text-2xl font-bold text-gray-800 mb-2"></h3>
                    <p id="photoDesc" class="text-gray-600"></p>
                </div>

                {{-- LIKE BUTTON --}}
                <div class="flex items-center gap-4 mb-6 pb-4 border-b">
                    <button id="likeButton" 
                            class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 hover:scale-105"
                            data-photo-id="">
                        <svg id="likeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span id="likeCount" class="font-semibold">0</span>
                    </button>
                </div>

                {{-- COMMENTS SECTION --}}
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Comments</h4>
                    
                    {{-- Comment Form --}}
                    <form id="commentForm" class="mb-4">
                        <input type="text" name="website" class="hidden" autocomplete="off">
                        @guest('web')
                        <div class="mb-2">
                            <input type="text" 
                                   id="commentName" 
                                   name="name" 
                                   placeholder="Your name (optional)" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        @endguest
                        <div class="mb-2">
                            <textarea id="commentContent" 
                                      name="content" 
                                      rows="3" 
                                      placeholder="Write a comment..." 
                                      required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Post Comment
                        </button>
                    </form>

                    {{-- Comments List --}}
                    <div id="commentsList" class="space-y-3 max-h-64 overflow-y-auto">
                        <!-- Comments will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
     SCRIPT
======================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoTriggers = document.querySelectorAll('.photo-view-trigger');
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    const photoName = document.getElementById('photoName');
    const photoDesc = document.getElementById('photoDesc');
    const closeModal = document.getElementById('closeModal');
    const prevPhoto = document.getElementById('prevPhoto');
    const nextPhoto = document.getElementById('nextPhoto');
    const likeButton = document.getElementById('likeButton');
    const likeIcon = document.getElementById('likeIcon');
    const likeCount = document.getElementById('likeCount');
    const commentForm = document.getElementById('commentForm');
    const commentsList = document.getElementById('commentsList');

    let currentIndex = 0;
    let currentPhotoId = null;
    const photos = Array.from(photoTriggers).map(el => ({
        id: el.dataset.photoId,
        src: el.getAttribute('src'),
        name: el.dataset.photoName,
        desc: el.dataset.photoDesc
    }));

    // === OPEN MODAL ===
    photoTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            currentIndex = parseInt(this.dataset.photoIndex);
            openModal(currentIndex);
            trackPhotoView(this.dataset.photoId);
        });
    });

    function openModal(index) {
        const photo = photos[index];
        currentPhotoId = photo.id;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        modalImage.src = photo.src;
        photoName.textContent = photo.name;
        photoDesc.textContent = photo.desc || '';
        likeButton.dataset.photoId = photo.id;
        
        // Load like status and comments
        loadLikeStatus(photo.id);
        loadComments(photo.id);
    }

    function closeModalFunc() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        currentPhotoId = null;
    }

    closeModal.addEventListener('click', closeModalFunc);

    // Navigasi manual
    prevPhoto.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + photos.length) % photos.length;
        openModal(currentIndex);
        trackPhotoView(photos[currentIndex].id);
    });

    nextPhoto.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % photos.length;
        openModal(currentIndex);
        trackPhotoView(photos[currentIndex].id);
    });

    // Navigasi keyboard
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('hidden')) return;
        if (e.key === 'ArrowLeft') prevPhoto.click();
        if (e.key === 'ArrowRight') nextPhoto.click();
        if (e.key === 'Escape') closeModalFunc();
    });

    // Track views saat kelihatan
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const photoId = entry.target.getAttribute('data-photo-id');
                trackPhotoView(photoId);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    photoTriggers.forEach(trigger => observer.observe(trigger));

    function trackPhotoView(photoId) {
        fetch(`/guest/facilities/photos/${photoId}/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).catch(err => console.error('View tracking failed:', err));
    }

    // === LIKE FUNCTIONALITY ===
    function loadLikeStatus(photoId) {
        fetch(`/guest/facilities/photos/${photoId}/like-status`)
            .then(res => res.json())
            .then(data => {
                updateLikeButton(data.liked, data.like_count);
            })
            .catch(err => console.error('Failed to load like status:', err));
    }

    function updateLikeButton(liked, count) {
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

    likeButton.addEventListener('click', function() {
        const photoId = this.dataset.photoId;
        if (!photoId) return;

        fetch(`/guest/facilities/photos/${photoId}/like`, {
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

    // === COMMENT FUNCTIONALITY ===
    function loadComments(photoId) {
        fetch(`/guest/facilities/photos/${photoId}/comments`)
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
            <div class="bg-gray-50 rounded-lg p-3">
                <div class="flex items-start justify-between mb-1">
                    <span class="font-semibold text-sm text-gray-800">${escapeHtml(comment.name || 'Anonymous')}</span>
                    <span class="text-xs text-gray-500">${formatDate(comment.created_at)}</span>
                </div>
                <p class="text-sm text-gray-700">${escapeHtml(comment.content)}</p>
            </div>
        `).join('');
    }

    commentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!currentPhotoId) return;

        const formData = new FormData(commentForm);
        const data = {
            content: formData.get('content'),
            website: formData.get('website')
        };
        
        // Only add name if field exists (for guests)
        if (formData.has('name')) {
            data.name = formData.get('name');
        }

        fetch(`/guest/facilities/photos/${currentPhotoId}/comments`, {
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
                loadComments(currentPhotoId);
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

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
@endsection
