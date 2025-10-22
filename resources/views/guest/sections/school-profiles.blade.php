{{-- sections/school-profiles.blade.php --}}

{{-- Hero Section --}}
<section id="hero" class="relative h-[60vh] flex items-center justify-center overflow-hidden bg-gray-200">
    {{-- Background Image Parallax --}}
    <img src="{{ $profile->hero_image ? asset('storage/' . $profile->hero_image) : 'https://picsum.photos/1600/900?random=1' }}" 
         alt="School Placeholder" 
         class="absolute inset-0 w-full h-full object-cover opacity-80">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    {{-- Text Content --}}
    <div class="relative z-10 text-center text-white px-6">
        <h1 class="text-3xl md:text-4xl font-bold drop-shadow-lg" data-aos="fade-up">
            {{ $profile->title ?? 'Hogwarts School' }}
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-lg" data-aos="fade-up" data-aos-delay="200">
            Welcome to the magical world of Hogwarts
        </p>

        @if(!empty($profile->logo))
            <div class="mt-4 flex justify-center" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $profile->logo) }}" alt="School Logo" class="h-16 w-auto rounded-md shadow-lg bg-white/60 p-2">
            </div>
        @endif
    </div>
</section>



{{-- About + Location Section --}}
<section id="about" class="py-16 px-6 bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        
        {{-- About (2/3) --}}
        <div class="lg:col-span-2" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">About the School</h2>
            <div class="prose prose-lg max-w-none">
                <p class="text-gray-700 leading-relaxed text-lg">
                    {{ $profile->about ?? 'Welcome to Hogwarts School of Witchcraft and Wizardry, the world\'s foremost institution for magical education. Founded around 990 A.D. by four of the greatest witches and wizards of the age: Godric Gryffindor, Helga Hufflepuff, Rowena Ravenclaw, and Salazar Slytherin, each of whom established one of the four Houses.' }}
                </p>
            </div>
        </div>

        {{-- Location (1/3) --}}
        <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="150">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Location</h2>
            <div class="rounded-xl overflow-hidden shadow-lg bg-gray-100">
                @if(!empty($profile->map_embed))
                    {{-- Render saved embed code (trusted admin input) --}}
                    <div class="w-full h-64">
                        {!! $profile->map_embed !!}
                    </div>
                @else
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1984.954067890708!2d-0.127758!3d51.507351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b3333355555%3AHogwarts!2sLondon!5e0!3m2!1sen!2suk!4v1700000000000" 
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
            </div>
            
            {{-- Contact Info --}}
            @if($profile->address || $profile->phone || $profile->email)
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Contact Information</h3>
                    @if($profile->address)
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-indigo-500"></i>
                            {{ $profile->address }}
                        </p>
                    @endif
                    @if($profile->phone)
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-phone mr-2 text-indigo-500"></i>
                            {{ $profile->phone }}
                        </p>
                    @endif
                    @if($profile->email)
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                            {{ $profile->email }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

    </div>
</section>


{{-- History Section --}}
<section id="history" class="py-16 px-6 bg-gray-50">
    <div class="max-w-5xl mx-auto" data-aos="fade-up">
        <h2 class="text-2xl font-bold mb-6">History</h2>

        {{-- Founded Year --}}
        @if(!empty($profile->founded_year))
            <p class="text-gray-600 mb-4">
                Founded in <span class="font-semibold">{{ $profile->founded_year }}</span>
            </p>
        @endif

        {{-- Main History Content --}}
        <p class="text-gray-700 leading-relaxed mb-6">
            {{ $profile->history ?? 'The school has a rich history dating back over a thousand years...' }}
        </p>

        {{-- Founders --}}
        @if(!empty($founders) && $founders->count())
            <h3 class="text-xl font-semibold mb-4">Founders</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($founders as $founder)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center text-center hover:shadow-lg transition" 
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <img src="{{ $founder->photo ? asset('storage/' . $founder->photo) : 'https://picsum.photos/150/150?random=' . $loop->index }}" 
                             alt="{{ $founder->name }}" 
                             class="w-24 h-24 rounded-full mb-3 object-cover">
                        <h4 class="font-bold text-lg text-amber-700">{{ $founder->name }}</h4>
                        <p class="text-gray-600 text-sm mt-1">{{ $founder->role ?? 'Founder' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Students Overview Section -->
<section id="houses" class="py-16 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto">

        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Students Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                <!-- Left Column: Total + House Stats -->
                <div class="flex flex-col space-y-6">
                    <!-- Total Students -->
                    <div class="text-center">
                        <p id="totalStudents" 
                           class="text-5xl font-bold mb-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
                            {{ $totalStudents ?? 0 }}
                        </p>
                        <p class="text-gray-600">Total Students (last 7 years)</p>
                    </div>

                    <!-- House Stats -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        @foreach($houseStats as $house)
                            <div class="p-4 rounded-lg border shadow-sm text-center transform transition duration-500 ease-out
                                        hover:scale-105 hover:shadow-lg animate-fade-in-up"
                                 style="animation-delay: {{ $loop->index * 150 }}ms;">
                                <img src="{{ asset('storage/' . $house->logo) }}" 
                                     class="w-10 h-10 mx-auto mb-2" 
                                     alt="{{ $house->name }}">
                                <p class="font-semibold">{{ $house->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $house->students_last7years }} students</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Professors Overview -->
                <div class="flex flex-col space-y-6">
                    <div class="bg-gray-50 rounded-xl shadow-md p-6 text-center">
                        <h3 class="text-xl font-semibold text-amber-700">Professors</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProfessors ?? 0 }}</p>
                    </div>

                    <!-- Optional: Chart.js placeholder -->
                    <div class="w-full h-64">
                        <canvas id="studentChart" class="w-full h-full"></canvas>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


{{-- Scripts for Parallax + AOS --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script>
  AOS.init({
    duration: 500,
    once: true
  });

  // Parallax Background Hero
  const heroImg = document.querySelector('#hero img');
  window.addEventListener('scroll', () => {
      const scroll = window.scrollY;
      heroImg.style.transform = `translateY(${scroll * 0.3}px) scale(1.05)`;
  });
</script>
