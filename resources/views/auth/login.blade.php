<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PTPN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-200 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white w-full max-w-md p-10 rounded-xl shadow-md">
        <h2 class="text-center text-2xl font-bold mb-8 text-black">LOGIN</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Email"
                    class="w-full px-4 py-3 bg-yellow-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-white-100 text-sm" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <input id="password" type="password" name="password" required
                    placeholder="Password"
                    class="w-full px-4 py-3 bg-yellow-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-white-100 text-sm" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md transition">
                    Log in
                </button>
            </div>
        </form>
    </div>

</body>
</html>
