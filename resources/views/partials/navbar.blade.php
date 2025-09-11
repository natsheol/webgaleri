<nav class="fixed top-6 left-1/2 transform -translate-x-1/2 w-[95%] md:w-[90%] bg-white shadow-lg rounded-full z-50 border border-gray-200">
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">
          <!-- Logo & Nama Sekolah -->
          <div class="flex items-center space-x-3">
            <img src="{{ asset('images/icons/hogwarts-logo.png') }}" alt="Hogwarts Logo" class="w-12 h-12" />
            <span class="text-lg md:text-xl font-bold text-gray-800">Hogwarts School</span>
          </div>

          <!-- Menu Desktop -->
          <div class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Home</a>
            <a href="{{ url('/#profil') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Profile</a>
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Houses</a>
            <a href="#berita" class="text-gray-700 hover:text-indigo-600 font-medium transition">Sports</a>
            <a href="#event" class="text-gray-700 hover:text-indigo-600 font-medium transition">Event</a>
            <a href="{{ url('/hogwarts-prophet') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">HogwartsProphet</a>
            <a href="{{ route('facilities.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">Facilities</a>

            <a href="#kontak" class="text-gray-700 hover:text-indigo-600 font-medium transition">Contact</a>
          </div>

          <!-- Burger Menu Mobile -->
          <div class="md:hidden">
            <button class="text-gray-700 hover:text-indigo-600">
              <i class="fas fa-bars text-xl"></i>
            </button>
          </div>
        </div>
      </div>
    </nav>