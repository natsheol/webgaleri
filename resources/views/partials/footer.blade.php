@php
    use App\Models\SchoolProfile;
    $schoolProfile = SchoolProfile::first();
@endphp

<footer class="bg-[#0d0d0d] text-gray-200 mt-20 font-sans border-t border-[#3c5e5e]">
    <div class="container mx-auto px-6 py-12 grid md:grid-cols-2 lg:grid-cols-4 gap-10">
        {{-- School Info --}}
        <div>
            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Hogwarts School
            </h3>
            <p class="text-sm leading-relaxed text-gray-300">
                {{ $schoolProfile->address ?? 'Scotland, United Kingdom' }}
            </p>
            <p class="mt-3 italic text-gray-400">
                “{{ $schoolProfile->motto ?? 'Draco Dormiens Nunquam Titillandus' }}”
            </p>
        </div>

        {{-- Quick Links --}}
        <div>
            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Quick Links
            </h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Home</a></li>
                <li><a href="{{ url('/#profil') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Profile</a></li>
                <li><a href="{{ url('/houses') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Houses</a></li>
                <li><a href="{{ url('/facilities') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Facilities</a></li>
                <li><a href="{{ url('/achievements') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Achievements</a></li>
                <li><a href="{{ url('/hogwarts-prophet') }}" class="block text-gray-300 hover:text-white hover:underline underline-offset-4">Hogwarts Prophet</a></li>
            </ul>
        </div>

        {{-- Contact --}}
        <div>
            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Contact
            </h3>
            <div class="space-y-2 text-sm">
                <p class="flex items-center text-gray-300">
                    <i class="fas fa-envelope mr-2 text-[#425d9e]"></i>
                    {{ $schoolProfile->email ?? 'contact@hogwarts.edu' }}
                </p>
                <p class="flex items-center text-gray-300">
                    <i class="fas fa-phone mr-2 text-[#3c5e5e]"></i>
                    {{ $schoolProfile->phone ?? '+44 1234 567890' }}
                </p>
            </div>
        </div>

        {{-- Google Maps (Dynamic Embed) --}}
        <div>
            <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-gradient-to-b from-[#425d9e] via-[#3c5e5e] to-[#b03535] rounded-full"></span>
                Location
            </h3>

            @if (!empty($schoolProfile->map_embed))
                <div class="rounded-xl overflow-hidden shadow-md border border-[#3c5e5e]">
                    {!! $schoolProfile->map_embed !!}
                </div>
            @else
                <div class="p-4 bg-[#141414] border border-gray-700 rounded-xl text-sm text-gray-400">
                    <p>No map embedded yet. Please upload one in School Profile settings.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-[#3c5e5e] text-center py-4 text-sm text-gray-400 tracking-wide bg-[#101010]">
        © {{ date('Y') }} <span class="bg-gradient-to-r from-[#425d9e] via-[#3c5e5e] to-[#b03535] bg-clip-text text-transparent font-semibold">Hogwarts School</span>. All rights reserved.
    </div>
</footer>
