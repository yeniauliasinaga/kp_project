<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | PTPN IV Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex min-h-screen">
    <!-- Sidebar akan di-include berdasarkan role -->
    @auth
        @if(auth()->user()->pegawai->role === 'superadmin')
            @include('layouts.sidebarSuperadmin')
        @else
            @include('layouts.sidebarStaff')
        @endif
    @endauth

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto ml-60">
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>