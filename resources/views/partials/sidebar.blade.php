<aside class="w-64 bg-white h-screen shadow-md fixed top-0 left-0 z-50 flex flex-col">
    <div class="px-6 py-4 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800">Hogwarts Admin</h1>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="/admin" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin') ? 'bg-gray-200 font-semibold' : '' }}">
            Dashboard
        </a>

        <a href="/admin/hogwarts-prophet" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/hogwarts-prophet*') ? 'bg-gray-200 font-semibold' : '' }}">
            Hogwarts-prophet
        </a>

        <a href="/admin/achievements" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/achievements*') ? 'bg-gray-200 font-semibold' : '' }}">
            Achievements
        </a>

        <a href="/admin/facilities/categories" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/facilities*') ? 'bg-gray-200 font-semibold' : '' }}">
            Facility Categories
        </a>

        <a href="/admin/houses" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/houses*') ? 'bg-gray-200 font-semibold' : '' }}">
            Houses
        </a>

        <a href="{{ route('admin.school-profile.index') }}"
            class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/school-profile*') ? 'bg-gray-200 font-semibold' : '' }}">
            School Profile
        </a>


        <a href="/admin/settings" 
           class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition {{ request()->is('admin/settings*') ? 'bg-gray-200 font-semibold' : '' }}">
            Settings
        </a>

        <a href="/" class="flex items-center px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 transition">
            Back to Site
        </a>
    </nav>

    <div class="px-6 py-4 border-t border-gray-200 flex flex-col">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" 
                class="w-full flex items-center justify-center px-3 py-2 rounded-lg text-red-600 hover:bg-red-100 transition font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                </svg>
                Logout
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500 text-center">© {{ date('Y') }} Hogwarts Admin</p>
    </div>
</aside>
