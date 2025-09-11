@extends('layouts.manage')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit {{ $house->name }}</h1>

    {{-- Success message --}}
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Left Column: House Info --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <form action="{{ route('admin.houses.update', $house->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold mb-1">Legacy / Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded p-2">{{ $house->description }}</textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Characteristics (comma separated)</label>
                    <input type="text" name="characteristics"
                           value="{{ is_array($house->characteristics) ? implode(',', $house->characteristics) : $house->characteristics }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Logo</label>
                    @if($house->logo)
                        <img src="{{ asset('storage/' . $house->logo) }}" alt="Logo" class="w-16 h-16 mb-2">
                    @endif
                    <input type="file" name="logo" class="w-full border rounded p-2">
                </div>

                <button type="submit" class="px-4 py-2 bg-amber-700 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center hover:bg-amber-900">
                    Update House
                </button>
            </form>
        </div>

        {{-- Right Column: Student Overview --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-xl font-semibold mb-4">Student Overview</h1>
            <p><strong>Total Students (7 last years):</strong> {{ $totalStudents }}</p>
            <br>
            <h3 class="font-semibold text-gray-700 mb-2">Students per Year</h3>
            <ul class="space-y-1">
                @foreach ($studentsPerYear as $item)
                    <li class="flex justify-between bg-gray-50 p-2 rounded">
                        <span>{{ $item->year }}</span>
                        <span>{{ $item->total }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Achievements Section --}}
    <div class="bg-white p-6 rounded-lg shadow mt-8" x-data="{ open: false }">
        <h2 class="text-xl font-bold mb-4">Achievements in {{ $house->name }}</h2>

        {{-- Achievement List --}}
        <div class="space-y-3 mb-6">
            @forelse ($achievements as $item)
                <div class="flex items-center gap-4 bg-white shadow-sm rounded-lg p-3 border border-gray-100">
                    {{-- Image --}}
                    <div class="w-20 h-20 flex-shrink-0 rounded-md overflow-hidden bg-gray-200">
                        @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <i class="fas fa-trophy text-xl opacity-40"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow">
                        <h3 class="font-semibold text-gray-800">{{ $item->title }}</h3>
                        <p class="text-xs text-gray-600 mt-1">{{ Str::limit($item->description, 100) }}</p>
                        <div class="mt-2 text-xs text-gray-500">
                            <span class="font-medium text-amber-700">{{ $house->name }}</span>
                            <span>{{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d M Y') : '-' }}</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('admin.achievements.edit', $item->id) }}"
                        class="text-yellow-500 hover:text-yellow-600 flex items-center justify-center align-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18" />
                                    <path d="M7 17v-4l10 -10l4 4l-10 10h-4" />
                                    <path d="M14 6l4 4" />
                                    <path d="M14 6l4 4L21 7L17 3Z" fill="currentColor" fill-opacity="0.3" />
                                </svg>
                        </a>
                        <form action="{{ route('admin.achievements.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this achievement?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-500 hover:text-red-600 flex items-center justify-center align-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20h5c0.5 0 1 -0.5 1 -1v-14M12 20h-5c-0.5 0 -1 -0.5 -1 -1v-14" />
                                    <path d="M4 5h16" />
                                    <path d="M10 4h4M10 9v7M14 9v7" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-600">No achievements found.</div>
            @endforelse
        </div>

        {{-- Button Add Achievement --}}
        <button id="openAchievementModal" 
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 mb-4">
            Add New Achievement
        </button>

        {{-- Modal Overlay --}}
        <div id="achievementModal" 
            class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-6 relative">
                <button onclick="closeAchievementModal()" 
                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                
                <h3 class="text-lg font-semibold mb-4">Add New Achievement</h3>

                <form action="{{ route('admin.houses.storeAchievement', $house->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="house_id" value="{{ $house->id }}">

                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Title</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded p-2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Date</label>
                        <input type="date" name="date" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 font-medium">Image</label>
                        <input type="file" name="image" class="w-full border rounded p-2">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeAchievementModal()" 
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const achievementModal = document.getElementById('achievementModal');
            const openModalBtn = document.getElementById('openAchievementModal');

            openModalBtn.addEventListener('click', () => {
                achievementModal.classList.remove('hidden');
                achievementModal.classList.add('flex');
            });

            function closeAchievementModal() {
                achievementModal.classList.add('hidden');
                achievementModal.classList.remove('flex');
            }
        </script>
    </div>

    {{-- Professors Overview --}}
    <div class="bg-white p-6 rounded-lg shadow mt-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Professors in {{ $house->name }}</h2>
            <a href="{{ route('admin.professors.index', ['house_id' => $house->id]) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow text-sm whitespace-nowrap flex items-center hover:bg-blue-700">
               Manage Professors
            </a>
        </div>

        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Position</th>
                    <th class="py-2 px-4 border">Subject</th>
                    <th class="py-2 px-4 border">House</th>
                </tr>
            </thead>
            <tbody>
                @forelse($house->professors as $prof)
                    <tr>
                        <td class="py-2 px-4 border">{{ $prof->id }}</td>
                        <td class="py-2 px-4 border">{{ $prof->name }}</td>
                        <td class="py-2 px-4 border">{{ $prof->position ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $prof->subject ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $prof->house->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No professors yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
