<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Login</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <label for="email" class="block mb-2 font-semibold">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full px-3 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <label for="password" class="block mb-2 font-semibold">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                class="w-full px-3 py-2 mb-6 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
            >
                Login
            </button>
        </form>
    </div>

</body>
</html>
