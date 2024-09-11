<!-- resources/views/members/memberedit.blade.php -->
@extends('layouts.apps')

@section('content')
<main class="px-4 sm:px-8 py-6 overflow-y-hidden">
    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl font-medium mb-4 text-gray-800">Update Data Anggota</h1>

    <div class="md:mx-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-lg">
            <form id="updateForm" action="{{ route('members.update', $members->Member_ID) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="Name" class="block text-gray-700 mb-2">Nama</label>
                    <input type="text" name="Name" id="Name" value="{{ old('Name', $members->Name) }}" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="Email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="Email" id="Email" value="{{ old('Email', $members->Email) }}" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="Phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="Phone" id="Phone" value="{{ old('Phone', $members->Phone) }}" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="Address" class="block text-gray-700 mb-2">Alamat</label>
                    <textarea name="Address" id="Address" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>{{ old('Address', $members->Address) }}</textarea>
                </div>

                <!-- Membership Date -->
                <div class="mb-4">
                    <label for="Membership_Date" class="block text-gray-700 mb-2">Tanggal Bergabung</label>
                    <input type="date" name="Membership_Date" id="Membership_Date" value="{{ old('Membership_Date', $members->Membership_Date) }}" class="form-control w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex space-x-4">
                    <button type="button" id="updateBtn" class="bg-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-500">Update</button>
                    <a href="{{ route('members.detail', ['id' => $members->Member_ID]) }}" class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Update Anggota',
            text: "Apakah Anda yakin ingin memperbarui data anggota ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'custom-popup',
                confirmButton: 'custom-confirm-button',
                cancleButton: 'custom-cancle-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('updateForm').submit();
            }
        });
    });
</script>

@endsection
