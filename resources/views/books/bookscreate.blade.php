@extends('layouts.apps')

@section('content')
    <!-- Main Content -->
    <main class="px-4 sm:px-8 py-6 overflow-y-hidden">
    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl font-medium mb-4 text-gray-800 font-madetommysoft">Tambah Buku</h1>

    <div class="md:mx-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-lg">
            <form id="submitForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="Title" class="block text-gray-700 mb-2">Judul Buku</label>
                    <input type="text" id="Title" name="Title" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label for="Author" class="block text-gray-700 mb-2">Penulis</label>
                    <input type="text" id="Author" name="Author" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Publisher -->
                <div class="mb-4">
                    <label for="Publisher" class="block text-gray-700 mb-2">Penerbit</label>
                    <input type="text" id="Publisher" name="Publisher" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Year Published -->
                <div class="mb-4">
                    <label for="Year_Published" class="block text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" id="Year_Published" name="Year_Published" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Genre -->
                <div class="mb-4">
                    <label for="Genre" class="block text-gray-700 mb-2">Genre</label>
                    <input type="text" id="Genre" name="Genre" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- ISBN -->
                <div class="mb-4">
                    <label for="ISBN" class="block text-gray-700 mb-2">ISBN</label>
                    <input type="text" id="ISBN" name="ISBN" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="max 13 angka" required>
                </div>

                <!-- Copies Available -->
                <div class="mb-4">
                    <label for="Copies_Available" class="block text-gray-700 mb-2">Jumlah Salinan Tersedia</label>
                    <input type="number" id="Copies_Available" name="Copies_Available" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Book Picture -->
                <div class="mb-4">
                    <label for="Pict" class="block text-gray-700 mb-2">Gambar Buku</label>
                    <input type="file" id="Pict" name="Pict" class="w-full p-2 border border-gray-300 rounded-lg" accept="image/*">
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <button type="button" id="submitBtn" class="bg-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-500">Tambah Buku</button>
                    <a href="{{ route('books') }}" class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Batal</a>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Tambah Buku',
            text: "Apakah Anda yakin ingin menambahkan buku ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'custom-popup',
                confirmButton: 'custom-confirm-button',
                cancelButton: 'custom-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('submitForm').submit();
            }
        });
    });
</script>

@endsection
