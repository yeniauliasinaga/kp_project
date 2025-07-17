<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/8c8655eff1.js" crossorigin="anonymous"></script>

    <title>@yield('title') - Company Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex min-h-screen">
    <!-- Sidebar berdasarkan role -->
    @include('layouts.sidebarSuperadmin')
    @auth
        @if(auth()->user()->pegawai->role === 'superadmin')
            @include('layouts.sidebarSuperadmin')
        @else
            @include('layouts.sidebarStaff')
        @endif
    @endauth

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>