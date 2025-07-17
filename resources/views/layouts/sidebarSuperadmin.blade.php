<div class="ml-8 mt-8" id="divToggle">
    <button onclick="sidebar()" class="p-3 px-4 rounded-lg shadow-md bg-white w-fit h-fit z-10"
        style="transition: 0.25s;" id="buttonToggle">
        <i class="fa-solid fa-bars" id="toggle"></i>
    </button>
</div>

<div class="h-screen bg-gray-200 flex flex-col items-center fixed left-0 top-0 w-0 z-10" id="sidebar" style="transition: 0.3s;">
    <div class="overflow-x-hidden overflow-y-hidden flex flex-col items-center justify-center w-full" style="transition: 0.1s;">
         <!-- Logo -->
        <img src="{{ asset('asset/img/logo.png') }}" alt="Logo PTPN4" class="w-16 mb-4" id="logo" />
        <!-- Nama Instansi -->
        <h1 class="text-sm font-bold text-green-800 text-center">Pt Perkebunan IV Regional I</h1>
    </div>


    <!-- Menu Navigasi -->
    <nav class="w-full space-y-1 text-sm px-6">
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Dashboard</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Kendaraan</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Kegiatan</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Data Mess</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Hotel</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Tiket Pesawat</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Berita</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-gray-300 rounded">
                <span>Supir</span>
            </a>
        </div>
        <div class="overflow-x-hidden mt-8" style="transition: 0.3s;">
            <a href="#"
            class="flex items-center space-x-2 p-2 hover:bg-yellow-300 rounded">
                <span>Proposal</span>
            </a>
        </div>
    </nav>

</div>

<script>
const sidebar = () => {
    const sidebar = document.getElementById('sidebar');
    const icon = document.getElementById('toggle');
    const buttonToggle = document.getElementById('buttonToggle');
    const divToggle = document.getElementById('divToggle');
    
    if (sidebar.classList.contains('w-0')) {
        sidebar.classList.remove('w-0')
        sidebar.classList.add('w-60')
        icon.classList.remove('fa-bars')
        icon.classList.add('fa-xmark')
        buttonToggle.classList.add('ms-[17rem]')
        divToggle.classList.remove('ml-8')
    } else {
        sidebar.classList.add('w-0')
        sidebar.classList.remove('w-60')
        icon.classList.add('fa-bars')
        icon.classList.remove('fa-xmark')
        buttonToggle.classList.remove('ms-[17rem]')
        divToggle.classList.add('ml-8')
    }
}
</script>