@php
    $links = $links ?? [
        ['label' => 'Dashboard', 'route' => route('admin.dashboard')],
        ['label' => $title ?? 'Page', 'route' => null],
    ];
@endphp

<nav class="text-sm text-gray-500 mb-10 text-left">
    @foreach ($links as $index => $link)
        @if (!empty($link['route']))
            <a href="{{ $link['route'] }}" class="hover:text-gray-800 transition">
                {{ $link['label'] }}
            </a>
        @else
            <span class="text-gray-400">{{ $link['label'] }}</span>
        @endif

        @if ($index < count($links) - 1)
            <span class="mx-1">/</span>
        @endif
    @endforeach
</nav>
