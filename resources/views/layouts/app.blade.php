<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | PTPN IV</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
        <script src="{{ asset('build/assets/app.js') }}" defer></script>
    @endproduction

    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    @auth
        @if(auth()->user()->pegawai && auth()->user()->pegawai->role === 'superadmin')
            @include('layouts.sidebarSuperadmin')
        @else
            @include('layouts.sidebarStaff')
        @endif

        <div class="flex-1 ml-60 overflow-auto p-6">
            @yield('content')
        </div>
    @else
        <div class="w-full flex items-center justify-center">
            <div class="text-center p-8">
                <h1 class="text-2xl font-bold mb-4">Anda belum login</h1>
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Login Sekarang
                </a>
            </div>
        </div>
    @endauth

    @stack('scripts') 
</body>
</html>
