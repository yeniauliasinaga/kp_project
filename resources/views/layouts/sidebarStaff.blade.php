<div class="h-screen bg-gray-200 flex flex-col items-center p-4 w-60 fixed left-0 top-0">
    <!-- Logo -->
    <img src="{{ asset('asset/img/logo.png') }}" alt="Logo PTPN4" class="w-16 mb-4" />

    <!-- Nama Instansi -->
    <h1 class="text-sm font-bold text-green-800 text-center mb-6">Pt Perkebunan IV Regional I</h1>

    <!-- Menu Navigasi -->
    <nav class="w-full space-y-1 text-sm">
        <a href="{{ route('staff.dashboard') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.dashboard') ? 'bg-gray-300' : '' }}">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('staff.permintaankendaraan') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.permintaankendaraan*') ? 'bg-gray-300' : '' }}">
            <span>Permintaan Kendaraan</span>
        </a>
        <a href="{{ route('staff.kegiatan') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.kegiatan*') ? 'bg-gray-300' : '' }}">
            <span>Kegiatan</span>
        </a>
        <a href="{{ route('staff.checkinMess') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.checkinMess*') ? 'bg-gray-300' : '' }}">
            <span>Checkin Mess</span>
        </a>
        <a href="{{ route('staff.hotel') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.hotel*') ? 'bg-gray-300' : '' }}">
            <span>Hotel</span>
        </a>
        <a href="{{ route('staff.tiketPesawat') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.tiketPesawat*') ? 'bg-gray-300' : '' }}">
            <span>Tiket Pesawat</span>
        </a>
        <a href="{{ route('staff.berita') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded {{ request()->routeIs('staff.berita*') ? 'bg-gray-300' : '' }}">
            <span>Berita</span>
        </a>
        <a href="{{ route('staff.proposal') }}" 
           class="flex items-center space-x-2 p-2 hover:bg-yellow-300 rounded {{ request()->routeIs('staff.proposal*') ? 'bg-yellow-300' : '' }}">
            <span>Proposal</span>
        </a>
    </nav>

    <!-- Tombol Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-auto w-full">
        @csrf
        <button type="submit" 
                class="w-full text-left flex items-center space-x-2 p-2 px-10 text-red-700 hover:bg-red-100 rounded mt-6">
            <span>Logout</span>
        </button>
    </form>
</div>
