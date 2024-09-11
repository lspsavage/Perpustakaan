@extends('layouts.apps')

@section('content')

<main class="px-4 sm:px-8 py-6 overflow-y-hidden">
    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl font-medium mb-4 text-gray-800 font-madetommysoft">Formulir Edit Buku</h1>

    <div class="md:mx-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-lg">
            <form id="updateForm" action="{{ route('books.update', ['id' => $books->Book_ID]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 mb-2">Judul Buku</label>
                    <input type="text" id="title" name="Title" value="{{ old('Title', $books->Title) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label for="author" class="block text-gray-700 mb-2">Pengarang</label>
                    <input type="text" id="author" name="Author" value="{{ old('Author', $books->Author) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Publisher -->
                <div class="mb-4">
                    <label for="publisher" class="block text-gray-700 mb-2">Penerbit</label>
                    <input type="text" id="publisher" name="Publisher" value="{{ old('Publisher', $books->Publisher) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Year Published -->
                <div class="mb-4">
                    <label for="year_published" class="block text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" id="year_published" name="Year_Published" value="{{ old('Year_Published', $books->Year_Published) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Genre -->
                <div class="mb-4">
                    <label for="genre" class="block text-gray-700 mb-2">Genre</label>
                    <input type="text" id="genre" name="Genre" value="{{ old('Genre', $books->Genre) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- ISBN -->
                <div class="mb-4">
                    <label for="isbn" class="block text-gray-700 mb-2">ISBN</label>
                    <input type="text" id="isbn" name="ISBN" value="{{ old('ISBN', $books->ISBN) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Copies Available -->
                <div class="mb-4">
                    <label for="copies_available" class="block text-gray-700 mb-2">Jumlah Salinan Tersedia</label>
                    <input type="number" id="copies_available" name="Copies_Available" value="{{ old('Copies_Available', $books->Copies_Available) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Book Picture -->
                <div class="mb-4">
                    <label for="pict" class="block text-gray-700 mb-2">Gambar Buku</label>
                    <input type="file" id="pict" name="Pict" class="w-full p-2 border border-gray-300 rounded-lg">
                    @if($books->Pict)
                        <img src="{{ asset('images/' . $books->Pict) }}" alt="{{ $books->Title }}" class="mt-2 w-20 h-20 rounded-md">
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex space-x-4">
                    <div class="mt-6">
                        <button id="updateBtn" type="button" class="bg-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-500">Update</button>
                    </div>
                    <a href="{{ route('books.detail', ['id' => $books->Book_ID]) }}" class="mt-6">
                        <div class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Cancel</div>
                    </a>
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
            title: 'Konfirmasi Update Buku',
            text: "Apakah Anda yakin ingin memperbarui data buku ini?",
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