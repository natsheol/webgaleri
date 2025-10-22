<section id="hero" class="relative h-[80vh] flex items-center justify-center bg-white overflow-hidden">
    {{-- Optional: magic sparkles / particles --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="w-full h-full">
            {{-- Bisa tambahkan SVG star/particle animasi nanti --}}
        </div>
    </div>

    {{-- Konten utama --}}
    <div class="text-center px-6 md:px-12 relative z-10">
        <!-- Judul Gradient -->
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4
   bg-[linear-gradient(to_right,#b03535,#3c5e5e,#425d9e)]
   bg-clip-text text-transparent drop-shadow-lg"
   data-aos="fade-up">
    Welcome to Hogwarts School
</h1>


        <!-- Subtitle -->
        <p class="text-lg md:text-2xl mb-6 text-gray-700 drop-shadow"
           data-aos="fade-up" data-aos-delay="200">
            A place of magic, learning, and legendary stories.
        </p>

        <!-- Button CTA -->
        <a href="#about"
           class="inline-block px-6 py-3 md:px-8 md:py-4 font-semibold rounded-lg
                  bg-[linear-gradient(to_right,#b03535,#3c5e5e,#425d9e)]
                  text-white shadow-lg hover:scale-105 hover:shadow-xl transition-transform duration-300"
           data-aos="fade-up" data-aos-delay="400">
            Explore More
        </a>
    </div>
</section>
