@extends('layouts.manage')

@section('title', 'Dashboard')

@section('content')
<section class="min-h-screen bg-gray-100 pt-20 pb-10 px-6">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Welcome Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Welcome, {{ $admin->formal_name ?? 'Admin' }}
        </h1>
        <p class="text-gray-500 mb-10">Manage Hogwarts site from one place.</p>

        <!-- School Overview -->
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">School Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div>
                    <p class="text-lg font-semibold">{{ $school->title }}</p>
                    <p class="text-gray-600">{{ $school->address }}</p>
                    <p class="text-gray-600">{{ $school->phone }}</p>
                    <p class="text-gray-600">{{ $school->email }}</p>
                </div>
                <div class="flex justify-start md:justify-end">
                    <a href="{{ route('admin.school-profile.edit') }}" 
                       class="px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg">
                       Manage School Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Students Overview -->
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Students Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

                <!-- Total Students -->
                <div class="col-span-1 flex flex-col h-full">
                    <p id="totalStudents" class="text-5xl font-bold mb-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] bg-clip-text text-transparent">0</p>
                    <p class="text-gray-600 mb-4">Total Students (last 7 years)</p>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        @foreach($houseStats as $house)
                        <a href="{{ route('admin.students.index', ['house' => $house->id]) }}"
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

                <!-- Chart -->
                <div class="col-span-2 flex items-center">
                    <canvas id="studentChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Latest Hogwarts Prophet & Achievements -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Hogwarts Prophet Card -->
            <div class="bg-white shadow rounded-xl p-6 mb-6 relative">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Latest Hogwarts Prophet</h2>
                <div class="flex flex-col space-y-3">
                    @foreach($latestNews as $news)
                        <div class="flex gap-3 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 relative">
                            <div class="absolute px-2 py-1 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white text-xs font-semibold rounded-br-lg rounded-tr-lg">
                                {{ $news->category ?? 'General' }}
                            </div>
                            <div class="w-28 h-20 flex-shrink-0 overflow-hidden bg-gray-200 rounded-l-lg relative">
                                @if($news->image && file_exists(public_path('storage/' . $news->image)))
                                    <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover" alt="{{ $news->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-scroll"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-2 flex flex-col justify-center">
                                <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $news->title }}</h3>
                                <p class="text-xs text-gray-500 truncate">{{ Str::limit($news->content, 50) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.hogwarts-prophet.index') }}" 
                   class="mt-4 inline-block px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg text-sm">
                   Manage Hogwarts Prophet
                </a>
            </div>

            <!-- Achievements Card -->
            <div class="bg-white shadow rounded-xl p-6 mb-6 relative">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Latest Achievements</h2>
                <div class="flex flex-col space-y-3">
                    @foreach($latestAchievements as $achievement)
                        <div class="flex gap-3 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 relative">
                            <div class="absolute px-2 py-1 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white text-xs font-semibold rounded-br-lg rounded-tr-lg">
                                {{ $achievement->category ?? 'Achievement' }}
                            </div>
                            <div class="w-28 h-20 flex-shrink-0 overflow-hidden bg-gray-200 rounded-l-lg relative">
                                @if($achievement->image && file_exists(public_path('storage/' . $achievement->image)))
                                    <img src="{{ asset('storage/' . $achievement->image) }}" class="w-full h-full object-cover" alt="{{ $achievement->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-2 flex flex-col justify-center">
                                <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $achievement->title }}</h3>
                                <p class="text-xs text-gray-500 truncate">{{ Str::limit($achievement->description, 50) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.achievements.index') }}" 
                   class="mt-4 inline-block px-4 py-2 bg-gradient-to-r from-[#b03535] via-[#3c5e5e] to-[#425d9e] text-white rounded-lg text-sm">
                   Manage Achievements
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Chart.js & Total Students Count Up -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Count Up Total Students
    const el = document.getElementById('totalStudents');
    const target = {{ $studentsTotal }};
    let count = 0;
    const duration = 450;
    const stepTime = Math.max(Math.floor(duration / target), 1);

    const counter = setInterval(() => {
        count += 2;
        el.textContent = count;
        if (count >= target) clearInterval(counter);
    }, stepTime);

    // Chart.js
    const ctx = document.getElementById('studentChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($studentPerYear['years']) !!},
            datasets: [{
                label: 'Total Students',
                data: {!! json_encode($studentPerYear['totals']) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>
@endsection
