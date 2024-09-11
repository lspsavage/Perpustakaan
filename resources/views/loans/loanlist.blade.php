@extends('layouts.apps')

@section('content')

     <!-- Main Content -->
     <main class="px-8 py-6 overflow-y-hidden">
    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl font-medium mb-6 text-gray-800 font-madetommysoft">Daftar Pinjaman</h1>

    <!-- Search Box -->
    <div class="mb-6 flex justify-between">
        <form action="{{ route('loans') }}" method="GET" class="flex justify-start w-4/12">
            <div class="flex items-center justify-start w-full max-w-md mx-auto bg-white border border-gray-300 rounded-full shadow-sm overflow-hidden">
                <input 
                    type="text" name="search" value="{{ request('search') }}"
                    class="flex-grow px-4 py-2 text-gray-700 placeholder-gray-400 border-none focus:outline-none focus:ring-0" 
                    placeholder="Search for anything...">
                <button type="submit"
                    class="flex items-center justify-center w-12 h-12 bg-[#EFDBCD] text-white rounded-full transition-colors duration-200 hover:bg-orange-200 focus:outline-none">
                    <!-- Search Icon SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="black">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 5.6a7.5 7.5 0 010 10.8z" />
                    </svg>
                </button>
            </div>
            </form>
        <a href="{{ route('returns') }}" class="md:px-12"><div class="px-4 py-3 bg-lime-400 rounded-lg shadow-lg">Log Return</div></a>
    </div>

    <!-- Book List -->
    <div class="overflow-hidden">
        <!-- Table Header -->
        <div class="grid grid-cols-12 bg-beige-200 font-medium text-gray-700 py-3 bg-[#EFDBCD] shadow-md rounded-lg">
            <div class="col-span-1 text-center">No</div>
            <div class="col-span-2 text-center">Nama Anggota</div>
            <div class="col-span-2 text-center">Judul Buku</div>
            <div class="col-span-2 text-center">Tanggal Pinjam</div>
            <div class="col-span-2 text-center">Tanggal Kembali</div>
            <div class="col-span-1 text-center">Status</div>
            <div class="col-span-2 text-center">Aksi</div>
        </div>

        <!-- Spacing between header and content -->
        <div class="py-1"></div>

        <!-- Table Content -->
        <div class="overflow-y-auto max-h-96">
            @foreach ($loans as $index => $loan)
            <div class="py-1">
                <div class="grid grid-cols-12 bg-[#EFDBCD] py-2 shadow-md rounded-lg">
                    <div class="col-span-1 text-center">{{ $index + 1 }}</div>
                    <div class="col-span-2 text-center">{{ $loan->member->Name }}</div>
                    <div class="col-span-2 text-center">{{ $loan->book->Title }}</div>
                    <div class="col-span-2 text-center">{{ $loan->formatted_loan_date }}</div>
                    <div class="col-span-2 text-center">{{ $loan->formatted_return_date }}</div>
                    <div class="col-span-1 text-center">{{ $loan->status }}</div>
                    <div class="col-span-2 flex items-center justify-center space-x-6">
                        <a href="{{ route('members.detail', ['id' => $loan->member->Member_ID]) }}" class="px-4 py-2 bg-yellow-200 rounded-2xl shadow-lg hover:bg-yellow-300">Detail</a>
                        <a href="{{ route('returns.create', ['ID_loan' => $loan->ID_loan]) }}" class="px-4 py-2 bg-blue-300 rounded-2xl shadow-lg hover:bg-blue-400">Return</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Add more rows as needed -->
        </div>
    </div>
</main>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
