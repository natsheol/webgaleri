<section id="fasilitas" class="py-20 bg-gradient-to-b from-[#0c0c0c] via-[#111111] to-[#0c0c0c]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-white tracking-tight">Fasilitas Sekolah</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] mx-auto mt-4 rounded-full"></div>
            <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Menyediakan berbagai fasilitas modern untuk mendukung kenyamanan dan kualitas belajar mengajar.
            </p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($categories as $category)
                @php
                    $bgImage = $category->coverPhoto?->image 
                        ? asset('storage/' . $category->coverPhoto->image) 
                        : asset('/images/placeholder.jpg');
                @endphp

                <a href="{{ route('guest.facilities.show', $category->slug) }}" 
                   class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('{{ $bgImage }}');"></div>
                    <div class="absolute inset-0 bg-black/50 group-hover:bg-black/60 transition"></div>
                    <div class="absolute inset-0 flex items-center justify-center p-6">
                        <h3 class="text-2xl font-semibold text-white text-center drop-shadow-lg">
                            {{ $category->name }}
                        </h3>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-400 col-span-full">Belum ada fasilitas yang ditambahkan.</p>
            @endforelse
        </div>

        {{-- View More Button --}}
        <div class="mt-12 text-center">
            <a href="{{ route('guest.facilities.index') }}"
               class="inline-block bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] 
                      text-white font-semibold px-8 py-3 rounded-full 
                      hover:opacity-90 shadow-lg hover:shadow-xl transition">
                Lihat Semua Fasilitas
            </a>
        </div>
    </div>
</section>
