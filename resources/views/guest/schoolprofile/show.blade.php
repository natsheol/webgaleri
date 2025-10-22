@extends('layouts.guest')

@section('title', $profile->title ?? 'School Profile')

@section('content')
<section class="min-h-screen bg-gray-100 pt-20 pb-10 px-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- School Hero -->
        <div class="bg-white shadow rounded-xl p-6 mb-6 flex flex-col md:flex-row items-center gap-6">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800">{{ $profile->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $profile->address }}</p>
                <p class="text-gray-600">{{ $profile->phone }}</p>
                <p class="text-gray-600">{{ $profile->email }}</p>
            </div>
            @if($profile->logo)
                <img src="{{ asset('storage/' . $profile->logo) }}" class="w-32 h-32 object-cover rounded-lg" alt="Logo">
            @endif
        </div>

        <!-- Students Overview -->
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Students Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                <!-- Left Column: Total + Houses Stats -->
                <div class="flex flex-col space-y-6">
                    <!-- Total Students -->
                    <div class="text-center">
                        <p id="totalStudents" class="text-5xl font-bold mb-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">
                            {{ $totalStudents ?? 0 }}
                        </p>
                        <p class="text-gray-600">Active Students (last 7 years)</p>
                    </div>

                    <!-- House Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($houseStats as $house)
                            <a href="{{ route('guest.schoolprofile.show', ['house' => $house->id]) }}"
                                class="p-4 rounded-lg border shadow-sm text-center transform transition duration-500 ease-out
                                        hover:scale-105 hover:shadow-lg animate-fade-in-up"
                                style="animation-delay: {{ $loop->index * 150 }}ms;">
                                    <img src="{{ asset('storage/' . $house->logo) }}" class="w-10 h-10 mx-auto mb-2" alt="{{ $house->name }}">
                                    <p class="font-semibold">{{ $house->name }}</p>
                                    <p class="text-gray-600 text-sm">{{ $house->students_last7years }} students</p>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Professors Overview -->
                <div class="flex flex-col space-y-6">
                    <div class="bg-gray-50 rounded-xl shadow-md p-6 text-center">
                        <h3 class="text-xl font-semibold text-amber-700">Professors</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProfessors ?? 0 }}</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Count-up Animation -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('totalStudents');
    const target = {{ $totalStudents }};
    let count = 0;
    const duration = 450;
    const stepTime = Math.max(Math.floor(duration / target), 1);

    const counter = setInterval(() => {
        count += 2;
        if (count > target) count = target;
        el.textContent = count;
        if (count >= target) clearInterval(counter);
    }, stepTime);
});
</script>
@endsection
