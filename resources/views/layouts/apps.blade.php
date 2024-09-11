<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    @vite('resources/css/app.css')
    <!-- Link CSS tambahan akan ditambahkan di sini -->
    @yield('head') <!-- Tempat untuk menambahkan link CSS tambahan -->
</head>

<body class="grid grid-rows-[auto_1fr_auto] min-h-screen bg-beige font-madetommy">
    <!-- Header -->
    <header class="px-4 sm:px-8 pt-4">
        <div class="bg-[#EFDBCD] p-2 flex flex-wrap justify-between items-center shadow-md rounded-xl">
            <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                <p class="font-azonix text-lg sm:text-xl px-2 sm:px-4">Perpustakaan</p>
            </div>
            <div class="flex items-center space-x-4 sm:space-x-6 ml-auto">
                <nav class="flex flex-wrap space-x-4 sm:space-x-6 text-gray-800 items-center mb-2 sm:mb-0">
                    <a href="/" class="hover:underline">Beranda</a>
                    <a href="{{ route('books') }}" class="hover:underline">Buku</a>
                    <a href="{{ route('members') }}" class="hover:underline">Anggota</a>
                    <a href="{{ route('loans') }}" class="hover:underline">Pinjaman</a>
                </nav>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" id="logoutBtn" class="flex items-center px-2 py-2 text-white bg-red-500 rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v1m0 10v1M5 3h4a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                        </svg>
                    </button>
                </form>
                <img src="{{ Vite::asset('resources/image/Logo LS.png') }}" alt="Logo" class="w-8 sm:w-10 rounded-full">
            </div>
        </div>
    </header>

    <!-- Konten halaman akan ditambahkan di sini -->
    @yield('content')

    <!-- Footer -->
    <footer class="px-4 sm:px-8 pb-4">
        <div class="bg-[#EFDBCD] rounded-lg text-center p-4 mt-1 xl:mt-8 shadow-md">
            <p class="text-gray-600 text-sm sm:text-base">&copy; 2024 Perpustakaan. Semua Hak Cipta Dilindungi</p>
        </div>
    </footer>

    <!-- Skrip JavaScript tambahan akan ditambahkan di sini -->
    @yield('scripts')
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
