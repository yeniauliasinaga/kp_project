<div class="h-screen bg-gray-200 flex flex-col items-center p-4 w-60 fixed left-0 top-0">
    <!-- Logo -->
    <img src="{{ asset('img/logo.png') }}" alt="Logo PTPN4" class="w-16 mb-4" />

    <!-- Nama Instansi -->
    <h1 class="text-sm font-bold text-green-800 text-center mb-6">Pt Perkebunan IV Regional I</h1>

    <!-- Menu Navigasi -->
    <nav class="w-full space-y-1 text-sm">
        <a href="{{ route('superadmin.dashboard') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.dashboard') ? 'bg-gray-300' : '' }}">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('superadmin.datakendaraan.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.datakendaraan.*') ? 'bg-gray-300' : '' }}">
            <span>Kendaraan</span>
        </a>
        <a href="{{ route('superadmin.kegiatan.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.kegiatan.*') ? 'bg-gray-300' : '' }}">
            <span>Kegiatan</span>
        </a>
        <a href="{{ route('superadmin.datamess.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.datamess.*') ? 'bg-gray-300' : '' }}">
            <span>Data Mess</span>
        </a>
        <a href="{{ route('superadmin.hotel.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.hotel.*') ? 'bg-gray-300' : '' }}">
            <span>Hotel</span>
        </a>
        <a href="{{ route('superadmin.tiketpesawat.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.tiketpesawat.*') ? 'bg-gray-300' : '' }}">
            <span>Tiket Pesawat</span>
        </a>
        <a href="{{ route('superadmin.berita.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.berita.*') ? 'bg-gray-300' : '' }}">
            <span>Berita</span>
        </a>
        <a href="{{ route('superadmin.berita.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('superadmin.berita.*') ? 'bg-gray-300' : '' }}">
            <span>Supir</span>
        </a>
        <a href="{{ route('superadmin.proposal.index') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-yellow-300 rounded {{ request()->routeIs('superadmin.proposal.*') ? 'bg-yellow-300' : '' }}">
            <span>Proposal</span>
        </a>
    </nav>
</div>