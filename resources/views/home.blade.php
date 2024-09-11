<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    @vite('resources/css/app.css')
</head>

<body class="grid grid-rows-[1fr_auto] min-h-screen">
    <main class="bg-beige font-madetommy">

    <!-- Header -->
    <header class="px-4 sm:px-8 pt-4">
    <div class="bg-[#EFDBCD] p-2 flex flex-wrap justify-between items-center shadow-md rounded-xl">
        <div class="flex items-center space-x-2 mb-2 sm:mb-0">
            <p class="font-azonix text-lg sm:text-xl px-2 sm:px-4">Perpustakaan</p>
        </div>
        <!-- Wrapper for Nav and Logo -->
        <div class="flex items-center space-x-4 sm:space-x-6 ml-auto">
            <nav class="flex flex-wrap space-x-4 sm:space-x-6 text-gray-800 items-center mb-2 sm:mb-0">
                <a href="/" class="hover:underline">Beranda</a>
                <a href="{{route ('books')}}" class="hover:underline">Buku</a>
                <a href="{{route ('members')}}" class="hover:underline">Anggota</a>
                <a href="{{route ('loans') }}" class="hover:underline">Pinjaman</a>
            </nav>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logoutBtn" class="flex items-center px-2 py-2 text-white bg-red-500 rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v1m0 10v1M5 3h4a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                        </svg>
                    </button>
                </form>
            <img src="{{Vite::asset('resources/image/Logo LS.png')}}" alt="Logo" class="w-8 sm:w-10 rounded-full">
        </div>
    </div>
    </header>

    <!-- Main Content -->
    <div class="text-center px-8 py-6">
        <!-- Banner Image -->
         <div class="flex justify-center items-center">
        <div class="w-10/12 flex overflow-hidden rounded-lg shadow-xl mb-6">
            <img src="{{ Vite::asset('resources/image/perpustakaan.jpg') }}" alt="Library" class=" w-full h-64 object-cover">
        </div>
        </div>

        <!-- Welcome Text -->
        <h1 class="text-5xl font-tommyoutline font-medium mb-8 text-gray-800">Selamat Datang di Perpustakaan</h1>

        <!-- Options Section -->
        <div class="flex justify-center space-x-16 pb-1 xl:pb-10">
            <!-- Cari Buku -->
            <a href="{{route ('books')}}" class="text-center p-6 bg-[#EFDBCD] rounded-lg shadow-lg hover:shadow-lg transition h-56">
                <img src="{{ Vite::asset('resources/image/logo-baca.png') }}" alt="Cari Buku" class="w-48 mx-auto">
                <div class="pt-10">
                    <div class="p-2 px-4 rounded-md shadow-md bg-[#EFDBCD] text-lg font-semibold text-gray-800">Cari Buku</div>
                </div>
            </a>
            <!-- Anggota -->
            <a href="{{route ('members')}}" class="text-center p-6 bg-[#EFDBCD] rounded-lg shadow-lg hover:shadow-lg transition h-56">
                <img src="{{ Vite::asset('resources/image/logo-group.png') }}" alt="Cari Buku" class="w-48 mx-auto -mt-3">
                <div class="pt-8">
                    <div class="p-2 px-4 rounded-md shadow-md bg-[#EFDBCD] text-lg font-semibold text-gray-800">Anggota</div>
                </div>
            </a>
        </div>
    </div>
    </main>
    <!-- Footer -->
     <footer class="px-8 pb-4">
    <div class="bg-[#EFDBCD] rounded-lg text-center p-4 mt-1 xl:mt-8 shadow-md">
        <p class="text-gray-600">&copy; 2024 Perpustakaan. Semua Hak Cipta Dilindungi</p>
    </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi LogOut',
            text: "Apakah Anda yakin ingin Keluar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'custom-popup',
                confirmButton: 'custom-confirm-button',
                cancelButton: 'custom-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>

</body>

</html>
