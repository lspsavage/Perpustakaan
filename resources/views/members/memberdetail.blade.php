@extends('layouts.apps')

@section('content')

    <!-- Main Content -->
    <main class="px-4 sm:px-8 py-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Anggota</h1>
        <div class="xs:px-2 md:px-8 xl:px-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-md">
            @php
                use Carbon\Carbon;

                $formattedDate = Carbon::parse($members->Membership_Date)->translatedFormat('j F Y');
            @endphp
            <div class="mb-4 space-y-1">
                <h3 class="text-2xl font-bold mb-4">{{ $members->Name }}</h3>
                <p class="text-lg"><span class="font-medium">Email: </span> {{ $members->Email }}</p>
                <p class="text-lg"><span class="font-medium">Nomor Telepon: </span> {{ $members->Phone }}</p>
                <p class="text-lg"><span class="font-medium">Alamat: </span> {{ $members->Address }}</p>
                <p class="text-lg"><span class="font-medium">Bergabung Sejak: </span> {{ $formattedDate }}</p>
            </div>

            <!-- Daftar Buku yang Dipinjam -->
            <div class="mt-6">
                <h4 class="text-xl font-semibold mb-2">Buku yang Sedang Dipinjam:</h4>
                <ul class="list-disc list-inside">
                    @foreach($loans as $loan)
                    <li>Buku {{ $loan->book->Title }} - Tanggal Pinjam: {{ $loan->formatted_loan_date }} - Tanggal Kembali: {{ $loan->formatted_return_date }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('members.edit',['id' => $members->Member_ID]) }}" class="bg-blue-400 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-500">Update</a>
                <form id="deleteForm" action="{{ route('members.destroy', $members->Member_ID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" id="deleteBtn" class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Delete</button>
                </form>
                <a href="{{ route('members') }}" class="bg-lime-500 text-white px-4 py-2 rounded-lg shadow hover:bg-lime-600">Cancle</a>
            </div>
        </div>
        </div>
    </main>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('deleteBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Hapus Anggota',
            text: "Apakah Anda yakin ingin menghapus anggota ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'custom-popup',
                confirmButton: 'custom-confirm-button',
                cancelButton: 'custom-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    });
</script>
<script>
    // Menampilkan notifikasi sukses jika anggota berhasil ditambahkan
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection