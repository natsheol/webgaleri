<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Hogwarts School')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind via CDN (for quick prototyping) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-papCNhMlgNw1JfMT7yD9xkAcqZexOt+LsFbV+CGWhcX8Z5G0zDBi5wD2R53gT+5VCNsHk9WjoxbU9nU5ZK7eMA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Optional: Custom Tailwind Config (for colors/fonts) --}}
    {{-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        hogwarts: '#4b3f72',
                        gold: '#fcd34d',
                    }
                }
            }
        }
    </script> --}}
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main content with left padding to prevent overlap --}}
    <main class="pl-64 pt-6">
        <div class="container mx-auto px-6">
            {{-- Optional back button slot --}}
            @yield('back-button')

            {{-- Page content --}}
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
