<section id="hogwarts-prophet" class="py-20 bg-gradient-to-b from-[#f8f5f0] to-[#f1ece4]">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-14">
            <h2 class="text-4xl font-extrabold text-amber-800 drop-shadow-md tracking-wide">The Hogwarts Prophet</h2>
            <p class="text-gray-600 mt-3 text-lg italic">Whispers, wonders, and the latest news from our magical halls</p>
            <div class="w-24 h-1 bg-amber-600 mx-auto mt-4 rounded-full"></div>
        </div>

        {{-- News Cards --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($news->take(3) as $item)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 border border-amber-100 hover:-translate-y-1">
                    {{-- Image --}}
                    <div class="relative h-52 overflow-hidden">
                        @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->title }}"
                                 class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-amber-700 text-white">
                                <i class="fas fa-scroll text-4xl opacity-60"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-60 group-hover:opacity-80 transition"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6">
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                            <span>{{ $item->created_at->format('M d, Y') }}</span>
                            <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded-md text-[11px] font-semibold uppercase">
                                {{ $item->category ?? 'General' }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-amber-700 transition">
                            {{ $item->title }}
                        </h3>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ Str::limit(strip_tags($item->content), 110) }}
                        </p>

                        <a href="{{ route('guest.hogwarts-prophet.show', $item->id) }}"
                           class="text-amber-700 font-semibold text-sm hover:text-amber-900 transition flex items-center gap-1">
                            Read More 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- View All Button --}}
        <div class="text-center mt-14">
            <a href="{{ route('guest.hogwarts-prophet.index') }}"
               class="inline-block bg-amber-700 text-white px-8 py-3 rounded-xl shadow-md hover:bg-amber-800 hover:shadow-lg transition font-semibold tracking-wide">
                View All Articles
            </a>
        </div>
    </div>
</section>
