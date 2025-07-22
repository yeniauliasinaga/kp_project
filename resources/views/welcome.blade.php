<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - PTPN III (Persero)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-[#222222]">

    {{-- Navbar --}}
    <header class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-white shadow-sm sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <img src="{{ asset('asset/img/logo.png') }}" alt="PTPN Logo" class="h-12">
            <span class="font-bold text-xl text-[#006838]">Perkebunan Nusantara</span>
        </div>
        <nav class="flex gap-4">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium hover:text-green-700 transition">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-green-700 transition">Login</a>
            @endauth
        </nav>
    </header>

    {{-- Hero Section --}}
    <section class="relative h-[75vh] bg-cover bg-center flex items-center justify-center text-white"
        style="background-image: url('{{ asset('asset/img/landing.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-md">Tentang Kami</h1>
            <p class="text-lg md:text-xl mb-6 max-w-2xl mx-auto drop-shadow-sm">
                Menjadi perusahaan perkebunan nasional yang unggul dan berkelanjutan.
            </p>
            <a href="#about-section" class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded-full text-white font-semibold text-sm transition">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    {{-- About Section --}}
    <main id="about-section" class="py-16 px-6 bg-white text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-[#006838] mb-4">PT Perkebunan Nusantara III (Persero)</h2>
            <p class="text-gray-700 leading-relaxed text-md">
                PTPN III (Persero) adalah perusahaan BUMN yang bergerak di bidang pengelolaan, pengolahan, dan pemasaran komoditas perkebunan seperti kelapa sawit, karet, tebu, teh, kopi, kakao, dan tembakau. Kami mengembangkan nilai tambah bagi pemegang saham serta masyarakat melalui prinsip berkelanjutan.
                <br><br>
                Saat ini, PTPN III telah memiliki merek nasional bernama <strong>"Nusakita"</strong> untuk produk turunan komoditas, serta beberapa merek lainnya dari anak perusahaan Grup PTPN.
            </p>
        </div>
    </main>

    {{-- Highlight / CTA Section --}}
    <section class="bg-green-700 text-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold mb-4">Kenapa Memilih Kami?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8 text-left">
                <div class="bg-white text-[#222222] rounded-xl shadow-lg p-6">
                    <h4 class="text-lg font-bold mb-2 text-[#006838]">Komoditas Unggul</h4>
                    <p class="text-sm">Kami mengelola komoditas unggulan seperti kelapa sawit, kopi, dan teh yang berkualitas tinggi.</p>
                </div>
                <div class="bg-white text-[#222222] rounded-xl shadow-lg p-6">
                    <h4 class="text-lg font-bold mb-2 text-[#006838]">Keberlanjutan</h4>
                    <p class="text-sm">Kami menjalankan bisnis dengan prinsip berkelanjutan dan tanggung jawab sosial.</p>
                </div>
                <div class="bg-white text-[#222222] rounded-xl shadow-lg p-6">
                    <h4 class="text-lg font-bold mb-2 text-[#006838]">Jaringan Luas</h4>
                    <p class="text-sm">Didukung oleh anak perusahaan yang tersebar di berbagai wilayah Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-[#222222] text-white text-center py-6 text-sm">
        &copy; {{ date('Y') }} PT Perkebunan Nusantara III (Persero). All rights reserved.
    </footer>

</body>
</html>
