<!-- resources/views/members/membercreate.blade.php -->
@extends('layouts.apps')

@section('content')
<main class="px-4 sm:px-8 py-6 overflow-y-hidden">
    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl font-medium mb-4 text-gray-800 font-madetommysoft">Tambah Anggota</h1>

    <div class="md:mx-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-lg">
            <form action="{{ route('members.store') }}" method="POST" id="memberForm">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="Name" class="block text-gray-700 mb-2">Nama</label>
                    <input type="text" name="Name" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="Email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="Email" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="Phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="Phone" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="Address" class="block text-gray-700 mb-2">Alamat</label>
                    <input type="text" name="Address" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Membership Date -->
                <div class="mb-4">
                    <label for="Membership_Date" class="block text-gray-700 mb-2">Tanggal Bergabung</label>
                    <input type="date" name="Membership_Date" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <button type="button" class="bg-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-500" id="submitBtn">Tambah</button>
                    <a href="{{ route('members') }}" class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Batal</a>
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
            title: 'Konfirmasi Tambah Anggota',
            text: "Apakah Anda yakin ingin menambahkan anggota ini?",
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
                document.getElementById('memberForm').submit();
            }
        });
    });
</script>

@endsection

