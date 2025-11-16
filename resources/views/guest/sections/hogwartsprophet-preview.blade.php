<section id="hogwarts-prophet" class="py-20 bg-gradient-to-b from-[#f8f5f0] to-[#f1ece4]">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold tracking-tight text-gray-900">The Hogwarts Prophet</h2>
            <div class="w-24 h-1 mx-auto mt-4">
                <svg width="100%" height="100%" viewBox="0 0 96 4" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#b03535" />
                            <stop offset="50%" style="stop-color:#3c5e5e" />
                            <stop offset="100%" style="stop-color:#425d9e" />
                        </linearGradient>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#gradient)" rx="2" ry="2" />
                </svg>
            </div>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Whispers, wonders, and the latest news from our magical halls
            </p>
        </div>

        {{-- News Cards --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($news->take(3) as $item)
            <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">
                {{-- Image --}}
                <div class="relative h-48 overflow-hidden">
                    @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-r from-[#7a1b1b] to-[#243c7a]">
                            <i class="fas fa-scroll text-4xl text-white opacity-75"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-black/60 backdrop-blur-sm rounded-full">
                            {{ $item->category ?? 'General' }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex-1">
                        <div class="text-sm text-gray-500 mb-2">
                            {{ $item->created_at->format('F j, Y') }}
                        </div>
                        <h3 class="text-xl font-serif font-semibold text-gray-900 mb-3 line-clamp-2">
                            {{ $item->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ Str::limit(strip_tags($item->content), 120) }}
                        </p>
                    </div>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('guest.hogwarts-prophet.show', $item->id) }}"
                           class="inline-flex items-center text-sm font-medium text-[#b03535] hover:text-[#7a1b1b] transition-colors group-hover:underline">
                            Read Full Story
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- View All Button --}}
        <div class="mt-12 text-center">
            <a href="{{ route('guest.hogwarts-prophet.index') }}"
               class="relative overflow-hidden group inline-block px-8 py-3 font-serif rounded-full
                      text-white tracking-wide shadow-md hover:shadow-lg transition-all duration-300
                      hover:scale-105"
               style="
                    background: linear-gradient(90deg, #b03535 0%, #3c5e5e 50%, #425d9e 100%);
                    background-clip: padding-box;">
                <span class="relative z-10">View All Articles</span>
            </a>
        </div>
    </div>
</section>