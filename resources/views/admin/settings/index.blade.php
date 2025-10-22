@extends('admin.layout')

@section('title', 'Settings')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Website Settings</h1>
            <nav class="text-sm text-gray-600">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span>Settings</span>
            </nav>
        </div>
        <form action="{{ route('admin.settings.reset') }}" method="POST" onsubmit="return confirm('Are you sure you want to reset all settings to default values?')">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-undo mr-2"></i> Reset to Defaults
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($settings as $group => $groupSettings)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 capitalize border-b pb-2">
                    <i class="fas fa-{{ $group === 'general' ? 'cog' : ($group === 'contact' ? 'envelope' : ($group === 'social' ? 'share-alt' : 'palette')) }} mr-2"></i>
                    {{ ucfirst($group) }} Settings
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($groupSettings as $setting)
                        <div class="{{ $setting->type === 'textarea' ? 'md:col-span-2' : '' }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ ucwords(str_replace('_', ' ', str_replace($group . '_', '', $setting->key))) }}
                            </label>

                            @if($setting->type === 'text' || $setting->type === 'email' || $setting->type === 'url' || $setting->type === 'number')
                                <input type="{{ $setting->type }}" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            
                            @elseif($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" 
                                          rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            
                            @elseif($setting->type === 'image')
                                @if($setting->value)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->key }}" class="h-20 object-contain border rounded">
                                    </div>
                                @endif
                                <input type="file" 
                                       name="settings[{{ $setting->key }}]" 
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                            @endif

                            @error('settings.' . $setting->key)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
