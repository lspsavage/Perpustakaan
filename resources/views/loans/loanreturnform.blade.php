@extends('layouts.apps')

@section('content')
    <!-- Main Content -->
    <main class="px-8 py-6 overflow-y-hidden">
        <!-- Title -->
        <h1 class="text-2xl sm:text-3xl font-medium mb-6 text-gray-800 font-madetommysoft">Formulir Pengembalian Buku</h1>

        <!-- Form -->
        <div class="md:mx-24">
            <form id="submitForm" action="{{ route('returns.store') }}" method="POST" class="bg-[#EFDBCD] p-6 rounded-lg shadow-md">
                @csrf
                <!-- ID Loan Hidden Field -->
                <input type="hidden" id="ID_loan" name="ID_loan" value="{{ $loan->ID_loan }}">

                <div class="mb-4">
                    <label for="member_name" class="block text-gray-700 font-medium mb-2">Nama Anggota</label>
                    <input type="text" id="member_name" name="member_name" class="w-full p-2 border border-gray-300 bg-orange-100 rounded-lg" value="{{ $loan->member_name }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="book_title" class="block text-gray-700 font-medium mb-2">Judul Buku</label>
                    <input type="text" id="book_title" name="book_title" class="w-full p-2 border border-gray-300 bg-orange-100 rounded-lg" value="{{ $loan->book_title }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="returns_date" class="block text-gray-700 font-medium mb-2">Tanggal Pengembalian</label>
                    <input type="date" id="returns_date" name="returns_date" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="shape" class="block text-gray-700 font-medium mb-2">Kondisi Buku Saat Dikembalikan</label>
                    <select id="shape" name="shape" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak ringan">Rusak Ringan</option>
                        <option value="Rusak berat">Rusak Berat</option>
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="button" id="submitBtn" class="bg-blue-500 text-white px-4 py-2 rounded-2xl shadow hover:bg-blue-600">Return</button>
                    <a href="{{ route('loans') }}" class="bg-lime-500 text-white px-4 py-2 rounded-2xl shadow hover:bg-lime-600">Back</a>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Pengembalian Buku',
            text: "Apakah Anda yakin ingin mengembalikan buku ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kembalikan!',
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
