<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts School of Witchcraft and Wizard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#66B1F2',
                        'primary-dark': '#4A90E2',
                        'primary-light': '#B3D9FF'
                    }
                }
            }
        }
    </script>
    <!-- Tambahkan animasi di sini -->
  <style>
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-up {
      animation: fadeInUp 1s ease-out forwards;
    }
  </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section id="home" class="relative bg-gray-900 text-white pt-40 pb-20 overflow-hidden">
      <!-- Background Layer -->
      <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hogwarts.jpg') }}" 
            alt="Background" 
            class="w-full h-full object-cover opacity-60" />
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
      </div>

      <!-- Foreground Content -->
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          
          <!-- Left: Text Content -->
          <div class="animate-fade-in-up text-left">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-4 text-white drop-shadow-[0_4px_6px_rgba(200,180,255,0.5)]">
              HOGWARTS SCHOOL OF WITCHCRAFT AND WIZARD
            </h1>
            <p class="text-xl text-amber-100 font-semibold mb-4 drop-shadow-[0_2px_4px_rgba(255,210,120,0.4)]">
               <i>Draco Dormiens Nunquam Titillandus.</i>
            </p>
            <p class="text-white text-lg leading-relaxed mb-8 drop-shadow-[0_1px_3px_rgba(255,255,255,0.4)]">
              Forging a new generation of witches and wizards — wise, capable, and prepared to lead in the magical and non-magical world.
            </p>
            <a href="#profil"
              class="inline-block bg-gradient-to-r from-[#7c1d1d] via-[#1e3a3a] to-[#1e2a5a]
                      text-amber-100 font-semibold tracking-wide uppercase
                      py-3 px-8 rounded-full border border-amber-100/30
                      shadow-lg hover:shadow-[0_0_20px_rgba(255,235,180,0.3)]
                      transition duration-300">
              Discover Our School
            </a>
          </div>

          <!-- Right: Hogwarts Illustration -->
          <div class="animate-fade-in-up">
            <img src="{{ asset('images/students.png') }}" 
                alt="Hogwarts Students" 
                class="w-full max-w-3xl mx-auto rounded-xl shadow-2xl transition-transform duration-500" />
          </div>
        </div>
      </div>
</section>





    <!-- Profil Sekolah -->
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Heading -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">School Profile</h2>
                <div class="w-24 h-1 mx-auto mb-6 rounded-full bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e]"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                <b>Hogwarts School of Witchcraft and Wizardry</b> is the world’s foremost institution for magical education — a bastion of wisdom, legacy, and enchantment for generations of young witches and wizards.<br><br>
                Hogwarts School of Witchcraft and Wizardry was founded around the year 990 A.D. by four legendary witches and wizards: Godric Gryffindor, Helga Hufflepuff, Rowena Ravenclaw, and Salazar Slytherin. 
                Each founder established one of the <b>four Houses of Hogwarts, shaping the values and traditions that remain at the heart of the school to this day. 
                </p>
            </div>

            <!-- VISI MISI -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- Vision -->
            <div class="bg-gradient-to-tr from-[#1c1b2f] to-[#2a2a40] text-gray-100 p-6 rounded-xl shadow-lg border border-gray-700/40">
              <h3 class="text-2xl font-bold mb-2 text-indigo-100">Our Vision</h3>
              <p class="leading-relaxed text-gray-300">
                To provide a safe and enriching environment where young witches and wizards can master the magical arts,
                cultivate strong moral character, and grow into wise, capable members of the wizarding world.
              </p>
            </div>

            <!-- Mission -->
            <div class="bg-gradient-to-tr from-[#1a1f2d] to-[#20283e] text-gray-100 p-6 rounded-xl shadow-lg border border-gray-700/40">
                <h3 class="text-2xl font-bold mb-4 text-indigo-100">Our Mission</h3>
                <ul class="space-y-3 text-gray-300">
                  <li class="flex items-start">
                    <i class="fas fa-check-circle text-emerald-400 mr-3 mt-1"></i>
                    To uphold the ancient traditions of magical education, fostering knowledge and character.
                  </li>
                  <li class="flex items-start">
                    <i class="fas fa-check-circle text-emerald-400 mr-3 mt-1"></i>
                    To promote unity among witches and wizards of all backgrounds.
                  </li>
                  <li class="flex items-start">
                    <i class="fas fa-check-circle text-emerald-400 mr-3 mt-1"></i>
                    To shape curious minds into skilled, ethical, and courageous magic-users.
                  </li>
                </ul>
              </div>
            </div>



              <!-- House Banner -->
                <div class="group/grid grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- Gryffindor -->
                    <div class="relative peer hover:scale-105 transition-all duration-500" onmouseover="handleHover(this)" onmouseout="handleLeave(this)">
                      <div class="h-[300px] bg-[#2a0000] text-white text-center px-4 shadow-lg border-t-4 border-[#a4161a] flex flex-col justify-center items-center transition-all duration-500 ease-in-out"
                          style="clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);">
                        <img src="{{ asset('images/icons/gryffindor.png') }}" alt="Gryffindor Logo" class="w-16 h-16 mb-4" />
                        <h4 class="text-xl font-bold">Gryffindor</h4>
                        <p class="text-sm">320 Students</p>
                      </div>
                    </div>

                    <!-- Slytherin -->
                    <div class="relative peer hover:scale-105 transition-all duration-500" onmouseover="handleHover(this)" onmouseout="handleLeave(this)">
                      <div class="h-[300px] bg-[#002b23] text-white text-center px-4 shadow-lg border-t-4 border-[#1a7f5a] flex flex-col justify-center items-center transition-all duration-500 ease-in-out"
                          style="clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);">
                        <img src="{{ asset('images/icons/slytherin-icon.png') }}" alt="Slytherin Logo" class="w-16 h-16 mb-4" />
                        <h4 class="text-xl font-bold">Slytherin</h4>
                        <p class="text-sm">350 Students</p>
                      </div>
                    </div>

                    <!-- Hufflepuff -->
                    <div class="relative peer hover:scale-105 transition-all duration-500" onmouseover="handleHover(this)" onmouseout="handleLeave(this)">
                      <div class="h-[300px] bg-[#3a2e00] text-white text-center px-4 shadow-lg border-t-4 border-[#e0b400] flex flex-col justify-center items-center transition-all duration-500 ease-in-out"
                          style="clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);">
                        <img src="{{ asset('images/icons/hufflepuff-icon.png') }}" alt="Hufflepuff Logo" class="w-16 h-16 mb-4" />
                        <h4 class="text-xl font-bold">Hufflepuff</h4>
                        <p class="text-sm">285 Students</p>
                      </div>
                    </div>

                    <!-- Ravenclaw -->
                    <div class="relative peer hover:scale-105 transition-all duration-500" onmouseover="handleHover(this)" onmouseout="handleLeave(this)">
                      <div class="h-[300px] bg-[#0a1a3d] text-white text-center px-4 shadow-lg border-t-4 border-[#b08968] flex flex-col justify-center items-center transition-all duration-500 ease-in-out"
                          style="clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);">
                        <img src="{{ asset('images/icons/ravenclaw-icon.png') }}" alt="Ravenclaw Logo" class="w-16 h-16 mb-4" />
                        <h4 class="text-xl font-bold">Ravenclaw</h4>
                        <p class="text-sm">275 Students</p>
                      </div>
                    </div>
                </div>
          </div>
      </section>

      
  <!-- Hogwarts Houses Section -->
  <section id="houses" class="py-20 bg-gray-950 text-white">
        <div class="max-w-6xl mx-auto px-6">
          <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Hogwarts Houses</h2>
            <div class="w-24 h-1 mx-auto mb-6 rounded-full bg-gradient-to-r from-[#e63946] via-[#1d3557] to-[#457b9d]"></div>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">Each house has its own unique values and qualities. Discover where you truly belong.</p>
          </div>

          <!-- Gryffindor -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#4a0c0c] via-[#2b0f14] to-[#240808] p-8 rounded-xl shadow-xl">
            <div>
              <img src="{{ asset('images/gryffindor-common.png') }}"
                  alt="Gryffindor Common Room"
                  class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
            </div>
            <div>
              <h3 class="text-2xl font-bold text-amber-200 mb-2">Gryffindor</h3>
              <p class="text-gray-100 mb-6 italic">
                Bravery, courage, and chivalry. Gryffindor stands for the bold-hearted who dare to do what’s right, even in the face of danger.
              </p>
              <!-- Divider -->
              <div class="w-32 h-0.5 bg-amber-300/80 mb-4"></div>
              <!-- House Details -->
              <ul class="space-y-2 text-gray-100 mb-4">
                <li><span class="font-medium">Head of House:</span> Prof. Minerva McGonagall</li>
                <li><i class="fas fa-user-graduate mr-2 text-amber-200"></i> 320 Students</li>
                <li><i class="fas fa-chalkboard-teacher mr-2 text-amber-200"></i> 7 Professors</li>
              </ul>
              <!-- Button -->
              <a href="#gryffindor-details"
                class="inline-block mt-4 bg-gradient-to-r from-[#5a0000] via-[#7c1d1d] to-[#aa0000]
                      text-yellow-100 font-semibold tracking-wide uppercase
                      py-3 px-8 rounded-full border border-yellow-100/20
                      shadow-md hover:shadow-[0_0_20px_rgba(255,215,100,0.4)]
                      transition duration-300">
                Discover Now
              </a>
            </div>
          </div>

          <!-- Slytherin -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#0a2e2b] via-[#113f3a] to-[#081e1b] p-8 rounded-xl shadow-xl">
            <div class="order-2 md:order-1">
              <img src="{{ asset('images/slytherin-common.png') }}"
                  alt="Slytherin Common Room"
                  class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
            </div>
            <div class="order-1 md:order-2">
              <h3 class="text-2xl font-bold text-emerald-200 mb-2">Slytherin</h3>
              <p class="text-gray-100 mb-6 italic">
                Ambition, cunning, and resourcefulness. Slytherin is home to those destined to lead and climb through daring paths.
              </p>
              <div class="w-32 h-0.5 bg-emerald-300/80 mb-4"></div>
              <ul class="space-y-2 text-gray-100 mb-4">
                <li><span class="font-medium">Head of House:</span> Prof. Severus Snape / Horace Slughorn</li>
                <li><i class="fas fa-user-graduate mr-2 text-emerald-200"></i> 320 Students</li>
                <li><i class="fas fa-chalkboard-teacher mr-2 text-emerald-200"></i> 7 Professors</li>
              </ul>
              <a href="#slytherin-details"
                class="inline-block mt-4 bg-gradient-to-r from-[#003322] via-[#1e3a3a] to-[#157a6e]
                      text-green-100 font-semibold tracking-wide uppercase
                      py-3 px-8 rounded-full border border-green-100/20
                      shadow-md hover:shadow-[0_0_20px_rgba(120,255,190,0.4)]
                      transition duration-300">
                Discover Now
              </a>
            </div>
          </div>

          <!-- Hufflepuff -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#3b2a00] via-[#5a3e00] to-[#201600] p-8 rounded-xl shadow-xl">
            <div class="order-2 md:order-1">
              <img src="{{ asset('images/hufflepuff-common.png') }}"
                  alt="Hufflepuff Common Room"
                  class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
            </div>
            <div class="order-1 md:order-2">
              <h3 class="text-2xl font-bold text-yellow-200 mb-2">Hufflepuff</h3>
              <p class="text-gray-100 mb-6 italic">
                Loyalty, patience, and dedication. Hufflepuff welcomes the kind-hearted who believe in fairness and hard work.
              </p>
              <div class="w-32 h-0.5 bg-yellow-300/80 mb-4"></div>
              <ul class="space-y-2 text-gray-100 mb-4">
                <li><span class="font-medium">Head of House:</span> Prof. Pomona Sprout</li>
                <li><i class="fas fa-user-graduate mr-2 text-yellow-200"></i> 320 Students</li>
                <li><i class="fas fa-chalkboard-teacher mr-2 text-yellow-200"></i> 5 Professors</li>
              </ul>
              <a href="#hufflepuff-details"
                class="inline-block mt-4 bg-gradient-to-r from-yellow-300 via-yellow-400 to-yellow-500
                      text-gray-900 font-semibold tracking-wide uppercase
                      py-3 px-8 rounded-full border border-yellow-100/30
                      shadow-md hover:shadow-[0_0_20px_rgba(255,240,150,0.4)]
                      transition duration-300">
                Discover Now
              </a>
            </div>
          </div>


          <!-- Ravenclaw -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#0c1a3f] via-[#1e2a5a] to-[#0a112e] p-8 rounded-xl shadow-xl">
            <div>
              <img src="{{ asset('images/ravenclaw-common.png') }}"
                  alt="Ravenclaw Common Room"
                  class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
            </div>
            <div>
              <h3 class="text-2xl font-bold text-blue-200 mb-2">Ravenclaw</h3>
              <p class="text-gray-100 mb-6 italic">
                Wisdom, wit, and creativity. Ravenclaw values seekers of knowledge and those who dare to think differently.
              </p>
              <div class="w-32 h-0.5 bg-blue-300/80 mb-4"></div>
              <ul class="space-y-2 text-gray-100 mb-4">
                <li><span class="font-medium">Head of House:</span> Prof. Filius Flitwick</li>
                <li><i class="fas fa-user-graduate mr-2 text-blue-200"></i> 320 Students</li>
                <li><i class="fas fa-chalkboard-teacher mr-2 text-blue-200"></i> 6 Professors</li>
              </ul>
              <a href="#ravenclaw-details"
                class="inline-block mt-4 bg-gradient-to-r from-[#1e2a5a] via-[#3a4f8f] to-[#517aa0]
                      text-blue-100 font-semibold tracking-wide uppercase
                      py-3 px-8 rounded-full border border-blue-100/20
                      shadow-md hover:shadow-[0_0_20px_rgba(160,200,255,0.4)]
                      transition duration-300">
                Discover Now
              </a>
            </div>
          </div>
    </section>
              


    <!-- Hogwarts Houses Section -->
 <section id="houses" class="py-20 bg-gray-950 text-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">Hogwarts Houses</h2>
          <div class="w-24 h-1 mx-auto mb-6 rounded-full bg-gradient-to-r from-[#e63946] via-[#1d3557] to-[#457b9d]"></div>
          <p class="text-xl text-gray-300 max-w-3xl mx-auto">Each house has its own unique values and qualities. Discover where you truly belong.</p>
        </div>

        <!-- Gryffindor -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#4a0c0c] via-[#2b0f14] to-[#240808] p-8 rounded-xl shadow-xl">
          <div>
            <img src="{{ asset('images/gryffindor-common.png') }}"
                alt="Gryffindor Common Room"
                class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
          </div>
          <div>
            <h3 class="text-2xl font-bold text-amber-200 mb-2">Gryffindor</h3>
            <p class="text-gray-100 mb-6 italic">
              Bravery, courage, and chivalry. Gryffindor stands for the bold-hearted who dare to do what’s right, even in the face of danger.
            </p>
            <!-- Divider -->
            <div class="w-32 h-0.5 bg-amber-300/80 mb-4"></div>
            <!-- House Details -->
            <ul class="space-y-2 text-gray-100 mb-4">
              <li><span class="font-medium">Head of House:</span> Prof. Minerva McGonagall</li>
              <li><i class="fas fa-user-graduate mr-2 text-amber-200"></i> 320 Students</li>
              <li><i class="fas fa-chalkboard-teacher mr-2 text-amber-200"></i> 7 Professors</li>
            </ul>
            <!-- Button -->
            <a href="#gryffindor-details"
              class="inline-block mt-4 bg-gradient-to-r from-[#5a0000] via-[#7c1d1d] to-[#aa0000]
                    text-yellow-100 font-semibold tracking-wide uppercase
                    py-3 px-8 rounded-full border border-yellow-100/20
                    shadow-md hover:shadow-[0_0_20px_rgba(255,215,100,0.4)]
                    transition duration-300">
              Discover Now
            </a>
          </div>
        </div>

        <!-- Slytherin -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#0a2e2b] via-[#113f3a] to-[#081e1b] p-8 rounded-xl shadow-xl">
          <div class="order-2 md:order-1">
            <img src="{{ asset('images/slytherin-common.png') }}"
                alt="Slytherin Common Room"
                class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
          </div>
          <div class="order-1 md:order-2">
            <h3 class="text-2xl font-bold text-emerald-200 mb-2">Slytherin</h3>
            <p class="text-gray-100 mb-6 italic">
              Ambition, cunning, and resourcefulness. Slytherin is home to those destined to lead and climb through daring paths.
            </p>
            <div class="w-32 h-0.5 bg-emerald-300/80 mb-4"></div>
            <ul class="space-y-2 text-gray-100 mb-4">
              <li><span class="font-medium">Head of House:</span> Prof. Severus Snape / Horace Slughorn</li>
              <li><i class="fas fa-user-graduate mr-2 text-emerald-200"></i> 320 Students</li>
              <li><i class="fas fa-chalkboard-teacher mr-2 text-emerald-200"></i> 7 Professors</li>
            </ul>
            <a href="#slytherin-details"
              class="inline-block mt-4 bg-gradient-to-r from-[#003322] via-[#1e3a3a] to-[#157a6e]
                    text-green-100 font-semibold tracking-wide uppercase
                    py-3 px-8 rounded-full border border-green-100/20
                    shadow-md hover:shadow-[0_0_20px_rgba(120,255,190,0.4)]
                    transition duration-300">
              Discover Now
            </a>
          </div>
        </div>

        <!-- Hufflepuff -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#3b2a00] via-[#5a3e00] to-[#201600] p-8 rounded-xl shadow-xl">
          <div class="order-2 md:order-1">
            <img src="{{ asset('images/hufflepuff-common.png') }}"
                alt="Hufflepuff Common Room"
                class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
          </div>
          <div class="order-1 md:order-2">
            <h3 class="text-2xl font-bold text-yellow-200 mb-2">Hufflepuff</h3>
            <p class="text-gray-100 mb-6 italic">
              Loyalty, patience, and dedication. Hufflepuff welcomes the kind-hearted who believe in fairness and hard work.
            </p>
            <div class="w-32 h-0.5 bg-yellow-300/80 mb-4"></div>
            <ul class="space-y-2 text-gray-100 mb-4">
              <li><span class="font-medium">Head of House:</span> Prof. Pomona Sprout</li>
              <li><i class="fas fa-user-graduate mr-2 text-yellow-200"></i> 320 Students</li>
              <li><i class="fas fa-chalkboard-teacher mr-2 text-yellow-200"></i> 5 Professors</li>
            </ul>
            <a href="#hufflepuff-details"
              class="inline-block mt-4 bg-gradient-to-r from-yellow-300 via-yellow-400 to-yellow-500
                    text-gray-900 font-semibold tracking-wide uppercase
                    py-3 px-8 rounded-full border border-yellow-100/30
                    shadow-md hover:shadow-[0_0_20px_rgba(255,240,150,0.4)]
                    transition duration-300">
              Discover Now
            </a>
          </div>
        </div>


        <!-- Ravenclaw -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 items-center bg-gradient-to-r from-[#0c1a3f] via-[#1e2a5a] to-[#0a112e] p-8 rounded-xl shadow-xl">
          <div>
            <img src="{{ asset('images/ravenclaw-common.png') }}"
                alt="Ravenclaw Common Room"
                class="w-full max-w-md mx-auto rounded-xl shadow-2xl brightness-90 saturate-150" />
          </div>
          <div>
            <h3 class="text-2xl font-bold text-blue-200 mb-2">Ravenclaw</h3>
            <p class="text-gray-100 mb-6 italic">
              Wisdom, wit, and creativity. Ravenclaw values seekers of knowledge and those who dare to think differently.
            </p>
            <div class="w-32 h-0.5 bg-blue-300/80 mb-4"></div>
            <ul class="space-y-2 text-gray-100 mb-4">
              <li><span class="font-medium">Head of House:</span> Prof. Filius Flitwick</li>
              <li><i class="fas fa-user-graduate mr-2 text-blue-200"></i> 320 Students</li>
              <li><i class="fas fa-chalkboard-teacher mr-2 text-blue-200"></i> 6 Professors</li>
            </ul>
            <a href="#ravenclaw-details"
              class="inline-block mt-4 bg-gradient-to-r from-[#1e2a5a] via-[#3a4f8f] to-[#517aa0]
                    text-blue-100 font-semibold tracking-wide uppercase
                    py-3 px-8 rounded-full border border-blue-100/20
                    shadow-md hover:shadow-[0_0_20px_rgba(160,200,255,0.4)]
                    transition duration-300">
              Discover Now
            </a>
          </div>
        </div>
  </section>


    <!-- Hogwarts Prophet -->
    <section id="achievement" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Latest Achievements</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Proud accomplishments by Hogwarts students and Houses</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Achievement 1 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                    <div class="h-48 bg-gradient-to-r from-yellow-600 to-yellow-800 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-magic text-white text-6xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>July 18, 2025</span>
                            <span class="mx-2">•</span>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Magic</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-yellow-800 transition-colors">Champion of the Dueling Tournament</h3>
                        <p class="text-gray-600 mb-4">Evelyn Stormblade from Gryffindor claimed the title in the Hogwarts-wide magical dueling tournament.</p>
                        <a href="#" class="text-yellow-800 font-semibold hover:text-yellow-900 transition-colors">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </article>

                <!-- Achievement 2 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                    <div class="h-48 bg-gradient-to-r from-indigo-600 to-indigo-800 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-chess-rook text-white text-6xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>July 10, 2025</span>
                            <span class="mx-2">•</span>
                            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">Academics</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-indigo-800 transition-colors">Ravenclaw Wins Academic Cup</h3>
                        <p class="text-gray-600 mb-4">Ravenclaw triumphed once again in the Hogwarts Academic Cup for outstanding performance in exams and magical research.</p>
                        <a href="#" class="text-indigo-800 font-semibold hover:text-indigo-900 transition-colors">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </article>

                <!-- Achievement 3 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                    <div class="h-48 bg-gradient-to-r from-green-600 to-green-800 relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-broom text-white text-6xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>July 5, 2025</span>
                            <span class="mx-2">•</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Sports</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-800 transition-colors">Slytherin Wins Quidditch Cup</h3>
                        <p class="text-gray-600 mb-4">Slytherin’s Quidditch team soared to victory, defeating all other Houses and bringing home the Hogwarts Cup 2025.</p>
                        <a href="#" class="text-green-800 font-semibold hover:text-green-900 transition-colors">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </article>
            </div>

            <div class="text-center mt-12">
                <button class="bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-primary-dark transition-colors">
                    View All Achievements
                </button>
            </div>
        </div>
    </section>




    <!-- Event Terbaru -->
    <section id="event" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Event Terbaru</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jangan lewatkan event-event menarik yang akan datang</p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-8">
                        <div class="flex items-start space-x-6">
                            <div class="bg-primary text-white rounded-xl p-4 text-center min-w-[80px]">
                                <div class="text-2xl font-bold">05</div>
                                <div class="text-sm opacity-90">AGU</div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Tech Expo 2025</h3>
                                <div class="flex items-center text-gray-500 text-sm mb-3">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>09:00 - 16:00 WIB</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Aula Utama</span>
                                </div>
                                <p class="text-gray-600 mb-4">Pameran teknologi terbaru dengan demo project siswa dan workshop dari industri teknologi terkemuka.</p>
                                <button class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-8">
                        <div class="flex items-start space-x-6">
                            <div class="bg-primary text-white rounded-xl p-4 text-center min-w-[80px]">
                                <div class="text-2xl font-bold">12</div>
                                <div class="text-sm opacity-90">AGU</div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Career Day 2025</h3>
                                <div class="flex items-center text-gray-500 text-sm mb-3">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>08:00 - 15:00 WIB</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Lapangan Sekolah</span>
                                </div>
                                <p class="text-gray-600 mb-4">Bursa kerja dan seminar karir dengan 50+ perusahaan partner untuk membuka peluang kerja lulusan.</p>
                                <button class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <button class="bg-primary text-white px-8 py-3 rounded-full font-semibold hover:bg-primary-dark transition-colors">
                    Lihat Semua Event
                </button>
            </div>
        </div>
    </section>

    {{-- Hogwarts Prophet Section --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-amber-800 text-center mb-8">Hogwarts Prophet</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                @forelse ($latestArticles as $item)
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="h-40 bg-gradient-to-r from-amber-600 to-amber-800 relative">
                            @if (!empty($item->image) && file_exists(public_path('storage/' . $item->image)))
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                    class="absolute inset-0 w-full h-full object-cover" 
                                    alt="{{ $item->title }}">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-scroll text-white text-5xl opacity-30"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800">{{ $item->title }}</h3>
                            <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($item->content, 80) }}</p>
                            <div class="mt-4 text-sm text-gray-500">
                                <span>{{ $item->writer }}</span> • 
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-center col-span-full text-gray-500">No news available.</p>
                @endforelse
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('hogwarts-prophet.index') }}" 
                  class="inline-block px-6 py-2 bg-amber-700 text-white rounded-lg hover:bg-amber-800 transition">
                    View All News
                </a>
            </div>
        </div>
    </section>





    <!-- FACILITIES -->
    <section id="fasilitas" class="py-20 bg-[#0c0c0c]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-white mb-4">Fasilitas Sekolah</h2>
          <div class="w-24 h-1 bg-amber-500 mx-auto mb-6"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Great hall -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/great-hall.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Great Hall</h3>
          </div>
        </div>

        <!-- Common rooms 2 -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/gryffindor-common.png');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">House Common Rooms</h3>
          </div>
        </div>

        <!-- Library -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/library.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Library</h3>
          </div>
        </div>

        <!-- Classrooms -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/classroom.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Classrooms</h3>
          </div>
        </div>

        <!-- Hospital Wing -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/hospital.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Hospital Wing</h3>
          </div>
        </div>

        <!-- Quidditch Pitch -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/quidditch.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Quidditch Pitch</h3>
          </div>
        </div>

        <!-- Greenhouses -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/greenhouse.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Greenhouses</h3>
          </div>
        </div>

        <!-- Room of Requirement -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/requirement.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Room of Requirement</h3>
          </div>
        </div>

        <!-- Prefect's Bathroom -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/bathroom.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Prefect's Bathroom</h3>
          </div>
        </div>

        <!-- Owlery -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/owlery.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Owlery</h3>
          </div>
        </div>

        <!-- Kitchen -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/kitchen.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Kitchen</h3>
          </div>
        </div>

        <!-- Astronomy Tower -->
        <div class="relative bg-cover bg-center rounded-xl overflow-hidden shadow-xl group min-h-[280px] md:min-h-[320px]" style="background-image: url('/images/astronomy-tower.jpg');">
          <div class="bg-black bg-opacity-60 group-hover:bg-opacity-70 transition-all duration-300 h-full w-full flex items-center justify-center text-center p-6">
            <h3 class="text-xl font-bold text-white drop-shadow-md">Astronomy Tower</h3>
          </div>
        </div>
      </div>

    </section>




    <!-- Peta Sekolah -->
    <section id="peta" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Lokasi Sekolah</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Temukan lokasi SMK Negeri 1 dan informasi kontak lengkap</p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Alamat</h4>
                                    <p class="text-gray-600">Jl. Pendidikan No. 123, Kota Bandung, Jawa Barat 40123</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Telepon</h4>
                                    <p class="text-gray-600">(022) 1234-5678</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Email</h4>
                                    <p class="text-gray-600">info@smkn1.sch.id</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 07:00 - 16:00 WIB</p>
                                    <p class="text-gray-600">Sabtu: 07:00 - 12:00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="h-96 bg-gradient-to-br from-primary-light to-primary flex items-center justify-center cursor-pointer hover:from-primary hover:to-primary-dark transition-all duration-300">
                        <div class="text-center text-white">
                            <i class="fas fa-map text-6xl mb-4 opacity-50"></i>
                            <p class="text-xl font-semibold">Peta Interaktif</p>
                            <p class="opacity-75">Klik untuk melihat lokasi di Google Maps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media & Footer -->
    <footer id="kontak" class="bg-gray-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-6">
                        <i class="fas fa-graduation-cap text-primary text-2xl mr-3"></i>
                        <span class="font-bold text-xl">SMK Negeri 1</span>
                    </div>
                    <p class="text-gray-300 mb-6">Berkarya Menuju Masa Depan Gemilang. Menjadi SMK unggul yang menghasilkan lulusan berkarakter dan kompeten.</p>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-primary hover:bg-primary-dark text-white p-3 rounded-lg transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-primary hover:bg-primary-dark text-white p-3 rounded-lg transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-primary hover:bg-primary-dark text-white p-3 rounded-lg transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="bg-primary hover:bg-primary-dark text-white p-3 rounded-lg transition-colors">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-6">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="#profil" class="text-gray-300 hover:text-primary transition-colors">Profil Sekolah</a></li>
                        <li><a href="#jurusan" class="text-gray-300 hover:text-primary transition-colors">Program Keahlian</a></li>
                        <li><a href="#berita" class="text-gray-300 hover:text-primary transition-colors">Berita</a></li>
                        <li><a href="#event" class="text-gray-300 hover:text-primary transition-colors">Event</a></li>
                        <li><a href="#galeri" class="text-gray-300 hover:text-primary transition-colors">Galeri</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-6">Program Keahlian</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors">Rekayasa Perangkat Lunak</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors">Teknik Komputer Jaringan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors">Desain Komunikasi Visual</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors">Akuntansi Keuangan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors">Bisnis Daring Pemasaran</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-6">Ikuti Kami</h3>
                    <p class="text-gray-300 mb-4">Dapatkan update terbaru dari SMK Negeri 1</p>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center text-gray-300 hover:text-primary transition-colors">
                            <i class="fab fa-facebook-f mr-3"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="flex items-center text-gray-300 hover:text-primary transition-colors">
                            <i class="fab fa-instagram mr-3"></i>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="flex items-center text-gray-300 hover:text-primary transition-colors">
                            <i class="fab fa-youtube mr-3"></i>
                            <span>YouTube</span>
                        </a>
                        <a href="#" class="flex items-center text-gray-300 hover:text-primary transition-colors">
                            <i class="fab fa-tiktok mr-3"></i>
                            <span>TikTok</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; 2025 SMK Negeri 1. All rights reserved. Made with ❤️ for education.</p>
            </div>
        </div>
    </footer>


    <script>
      function handleHover(el) {
        const peers = document.querySelectorAll('.peer');
        peers.forEach(card => {
          if (card !== el) {
            card.style.opacity = '0.8';
          }
        });
      }

      function handleLeave(el) {
        const peers = document.querySelectorAll('.peer');
        peers.forEach(card => {
          card.style.opacity = '1';
        });
      }
    </script>


  </body>
</html>