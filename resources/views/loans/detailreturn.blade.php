@extends('layouts.apps')

@section('content')

    <!-- Main Content -->
    <main class="px-4 sm:px-8 py-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Anggota</h1>
        <div class="xs:px-2 md:px-8 xl:px-24">
        <div class="bg-[#EFDBCD] p-6 rounded-lg shadow-md">

            <div class="mb-4 space-y-1 grid grid-cols-2">
              <div class="">
                <h3 class="text-2xl font-bold mb-4">{{ $returnlogs->member_name }}</h3>
                <p class="text-lg"><span class="font-medium">Nomor Telepon: </span> {{ $returnlogs->member_phone }}</p>
                <p class="text-lg"><span class="font-medium">Alamat: </span> {{ $returnlogs->member_address }}</p>
                </div>
                <div class="">
                <h3 class="text-2xl font-bold mb-4">{{ $returnlogs->book_title }}</h3>
                <p class="text-lg"><span class="font-medium">Dipinjam Pada: </span> {{ $returnlogs->formatted_loan_date }}</p>
                <p class="text-lg"><span class="font-medium">Estimasi Pengembalian Pada: </span> {{ $returnlogs->formatted_return_date }}</p>
                <p class="text-lg"><span class="font-medium">Dikembalikan Pada: </span> {{ $returnlogs->formatted_old_return_date }}</p>
                <p class="text-lg"><span class="font-medium">Kondisi Buku: </span> {{ $returnlogs->old_Shape }}</p>
                </div>
              </div>

            <!-- Actions -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('returns') }}" class="bg-lime-500 text-white px-4 py-2 rounded-lg shadow hover:bg-lime-600">Cancle</a>
            </div>
        </div>
        </div>
    </main>

@endsection
