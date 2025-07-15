<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTPN III (Persero)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-[#222222]">

    {{-- Navbar --}}
    <header class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
        <div class="flex items-center gap-2">
            <img src="{{ asset('asset/img/logo.png') }}" alt="PTPN Logo" class="h-12">
            <span class="font-bold text-xl">Perkebunan Nusantara</span>
        </div>
        <nav class="flex gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-[#222222] hover:text-[#38AB3A]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[#222222] hover:text-[#38AB3A]">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-medium text-[#222222] hover:text-[#38AB3A]">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    {{-- About Us --}}
    <main class="flex-grow flex items-center justify-center px-6 py-16 bg-white">
        <div class="max-w-3xl text-center">
            <h2 class="text-3xl font-bold mb-4">About Us</h2>
            <h3 class="text-xl font-semibold mb-6">PT Perkebunan Nusantara III (Persero)</h3>
            <p class="text-md leading-relaxed text-[#222222]">
                PT Perkebunan Nusantara III (Persero), commonly known as <strong>PTPN</strong>, is a State-Owned Enterprise (BUMN)
                holding company in the plantation sector, involved in the management, processing, and marketing of plantation
                commodities such as palm oil, rubber, sugarcane, tea, coffee, cocoa, and tobacco.
                <br><br>
                Currently, PT Perkebunan Nusantara III (Persero) has established a national brand called
                <strong>“Nusakita”</strong> in addition to several other brands owned by subsidiaries of the PTPN Group.
            </p>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-[#222222] text-white text-center py-6 text-sm">
        © {{ date('Y') }} PT Perkebunan Nusantara III (Persero). All rights reserved.
    </footer>

</body>
</html>
