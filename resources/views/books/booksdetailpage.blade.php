@extends('layouts.apps')


@section('content')

    <!-- Main Content -->
    <main class="px-4 sm:px-8 py-4">
        <!-- Title -->
<h1 class="text-3xl font-bold text-gray-800">Detail Buku</h1>
         <!-- Container -->
    <div class="container mx-auto px-10 pt-4 xl:px-48">

<!-- Book Detail Section -->
<div class="bg-[#EFDBCD] p-4 rounded-xl shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between">
    <!-- Book Details -->
    <div class="w-full sm:w-1/2 text-left">
        <div class="pl-6 space-y-4 xl:pl-24">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $books->Title }}</h2>
            <p class="text-lg"><span class="font-semibold">Pengarang:</span> {{ $books->Author }}</p>
            <p class="text-lg"><span class="font-semibold">Penerbit:</span> {{ $books->Publisher }}</p>
            <p class="text-lg"><span class="font-semibold">Tahun Terbit:</span> {{ $books->Year_Published }}</p>
            <p class="text-lg"><span class="font-semibold">Genre:</span> {{ $books->Genre }}</p>
            <p class="text-lg"><span class="font-semibold">ISBN:</span> {{ $books->ISBN }}</p>
            <p class="text-lg"><span class="font-semibold">Tersedia:</span> {{ $books->Copies_Available }} Buku</p><br>
        </div>
                    <!-- Actions -->
        <div class="flex justify-between">
        <div class="pl-6 xl:pl-24 mt-6 flex space-x-4">
            <a href="{{ route('loans.create', ['book_id' => $books->Book_ID]) }}" class="bg-emerald-400 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-green-500">Loan</a>
            <a href="{{route('books')}}" class="bg-lime-500 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-lime-600">Back</a>
        </div>
        <div class="pl-6 xl:pl-24 mt-6 flex space-x-4">
            <a href="{{route('books.edit', ['id' => $books->Book_ID])}}" class="bg-blue-400 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-blue-500">Update</a>
            <form id="deleteForm" action="{{ route('books.destroy', ['id' => $books->Book_ID]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
            @csrf
            @method('DELETE')
            <button id="deleteBtn" type="button" class="bg-red-500 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-red-600">Delete</button>
            </form>
        </div>
        </div>
    </div>

    <!-- Book Cover -->
    <div class="w-full sm:w-1/2 mt-6 sm:mt-0 flex justify-center">
        @if($books->Pict)
        <img src="{{ asset('images/' . $books->Pict) }}" alt="{{ $books->Title }}" class=" w-60 xl:w-72 rounded-xl border-2 border-gray-400 shadow-md">
        @endif
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
            title: 'Konfirmasi Hapus Buku',
            text: "Apakah Anda yakin ingin menghapus buku ini?",
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
