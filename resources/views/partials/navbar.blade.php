<nav class="bg-white shadow-md fixed w-full z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('storage/' . ($schoolProfile->logo ?? '')) }}" class="w-10 h-10 object-contain" alt="Logo">
                <span class="font-bold text-gray-800 text-lg">{{ $schoolProfile->school_name ?? 'Hogwarts' }}</span>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex lg:items-center lg:space-x-8">
                <a href="{{ route('guest.home') }}" class="block text-gray-700 hover:text-amber-700">Home</a>
                <a href="{{ route('guest.home') }}#about" class="block text-gray-700 hover:text-amber-700">Profile</a>
                <a href="{{ route('guest.home') }}#houses" class="block text-gray-700 hover:text-amber-700">Houses</a>
                <a href="{{ route('guest.hogwarts-prophet.index') }}" class="block text-gray-700 hover:text-amber-700">HogwartsProphet</a>
                <a href="{{ route('guest.facilities.index') }}" class="block text-gray-700 hover:text-amber-700">Facilities</a>
                <a href="{{ route('guest.home') }}#contact" class="block text-gray-700 hover:text-amber-700">Contact</a>
                
                {{-- User Auth Links --}}
                @auth('web')
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" class="flex items-center space-x-2 text-gray-700 hover:text-amber-700">
                            @if(Auth::guard('web')->user()->avatar)
                                <img src="{{ asset('storage/' . Auth::guard('web')->user()->avatar) }}" alt="{{ Auth::guard('web')->user()->name }}" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#b03535] via-[#3c5e5e] to-[#425d9e] flex items-center justify-center text-white text-sm font-bold">
                                    {{ strtoupper(substr(Auth::guard('web')->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="font-medium">{{ Auth::guard('web')->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div x-show="userMenu" @click.away="userMenu = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> My Profile
                            </a>
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('user.login') }}" class="text-gray-700 hover:text-amber-700">Login</a>
                    <a href="{{ route('user.register') }}" class="px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg hover:opacity-90 transition">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger Mobile -->
            <div class="flex lg:hidden">
                <button @click="open = !open" class="text-gray-700 hover:text-amber-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="lg:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('guest.home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Home</a>
        <a href="{{ route('guest.home') }}#school-profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Profile</a>
        <a href="{{ route('guest.home') }}#houses" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Houses</a>
        <a href="{{ route('guest.hogwarts-prophet.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">HogwartsProphet</a>
        <a href="{{ route('guest.facilities.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Facilities</a>
        <a href="{{ route('guest.home') }}#contact" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Contact</a>
        
        @auth('web')
            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                <i class="fas fa-user mr-2"></i> My Profile
            </a>
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('user.login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Login</a>
            <a href="{{ route('user.register') }}" class="block px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded text-center">Register</a>
        @endauth
    </div>
</nav>
