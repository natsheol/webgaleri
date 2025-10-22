<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="container mx-auto px-6 py-8 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div>
            <h3 class="text-lg font-bold text-white mb-3">Hogwarts School</h3>
            <p class="text-sm text-gray-300 leading-relaxed">
                Hogwarts School of Witchcraft and Wizardry, 
                Scotland, United Kingdom
            </p>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="block text-gray-300 hover:text-white transition-colors">Home</a></li>
                <li><a href="{{ url('/#profil') }}" class="block text-gray-300 hover:text-white transition-colors">Profile</a></li>
                <li><a href="{{ url('/houses') }}" class="block text-gray-300 hover:text-white transition-colors">Houses</a></li>
                <li><a href="{{ url('/facilities') }}" class="block text-gray-300 hover:text-white transition-colors">Facilities</a></li>
                <li><a href="{{ url('/achievements') }}" class="block text-gray-300 hover:text-white transition-colors">Achievements</a></li>
                <li><a href="{{ url('/hogwarts-prophet') }}" class="block text-gray-300 hover:text-white transition-colors">Hogwarts Prophet</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white mb-3">Contact</h3>
            <div class="space-y-2 text-sm">
                <p class="flex items-center text-gray-300">
                    <i class="fas fa-envelope mr-2 text-indigo-400"></i>
                    contact@hogwarts.edu
                </p>
                <p class="flex items-center text-gray-300">
                    <i class="fas fa-phone mr-2 text-indigo-400"></i>
                    +44 1234 567890
                </p>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-700 text-center py-4 text-sm text-gray-400">
        © {{ date('Y') }} Hogwarts School. All rights reserved.
    </div>
</footer>
