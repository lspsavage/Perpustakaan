@extends('layouts.apps')

@section('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
    <!-- Main Content -->
    <main class="px-4 sm:px-8 py-6 overflow-y-hidden">
        <!-- Title -->
        <h1 class="text-2xl sm:text-3xl font-medium mb-4 text-gray-800 font-madetommysoft">Formulir Peminjaman Buku</h1>

        <div class="md:mx-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-lg">
            <form id="submitForm" action="{{ route('loans.store') }}" method="POST">
                @csrf
                <!-- Book Selection -->
                <div class="mb-4">
                    <label for="book" class="block text-gray-700 mb-2">Pilih Buku</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" id="book" value="{{ $books->Title }}" disabled>
                    <input type="hidden" name="book_id" value="{{ $books->Book_ID }}">
                </div>

                <!-- Member Input-->
                <div class="mb-4">
                    <label for="member_search" class="block text-gray-700 mb-2">Pilih Anggota</label>
                    <input type="text" id="member_search" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Cari Anggota" required>
                    <input type="hidden" name="member_id" id="member_id">
                </div>


                <!-- Loan Date -->
                <div class="mb-4">
                    <label for="loan_date" class="block text-gray-700 mb-2">Tanggal Peminjaman</label>
                    <input type="date" id="loan_date" name="loan_date" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Return Date -->
                <div class="mb-4">
                    <label for="return_date" class="block text-gray-700 mb-2">Tanggal Pengembalian</label>
                    <input type="date" id="return_date" name="return_date" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>

                <!-- Submit Button -->
                 <div class="flex space-x-4">
                    <div class="mt-6">
                        <button type="button" id="submitBtn" class="bg-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-500">Submit</button>
                    </div>
                    <a href="{{ route('books') }}" class="mt-6">
                        <div class="bg-red-400 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500">Cancle</div>
                    </a>
                </div>
            </form>
        </div>
        </div>
    </main>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $("#member_search").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "{{ route('members.search') }}",
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    console.log(data); // Debug: lihat data yang diterima
                    response(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(
                        "Request failed: " + textStatus + ", " + errorThrown
                    );
                },
            });
        },
        minLength: 1,
        select: function (event, ui) {
            $("#member_id").val(ui.item.id); // Set the selected ID in the hidden input
            $("#member_search").val(ui.item.label); // Set the label in the input
        },
    });
});
</script>
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
