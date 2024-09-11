<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LoanController extends Controller
{
    public function loanpage (Request $request)
    {
        $search = $request->input('search');

        // Query loans dengan pencarian
        $loans = Loan::with(['book', 'member'])
        ->when($search, function ($query, $search) {
            // Pencarian pada relasi 'book' untuk Judul Buku
            $query->whereHas('book', function ($q) use ($search) {
                $q->where('Title', 'like', "%{$search}%");
            })
            // Pencarian pada relasi 'member' untuk Nama Anggota
            ->orWhereHas('member', function ($q) use ($search) {
                $q->where('Name', 'like', "%{$search}%");
            })
            // Pencarian pada kolom Tanggal Pinjam, Tanggal Kembali, dan Status di tabel loans
            ->orWhere('Loan_date', 'like', "%{$search}%")
            ->orWhere('Return_date', 'like', "%{$search}%");
        })
        ->get();

         // Format tanggal menggunakan Carbon
    foreach ($loans as $loan) {
        $loan->formatted_loan_date = Carbon::parse($loan->Loan_Date)->translatedFormat('j F Y');
        $loan->formatted_return_date = Carbon::parse($loan->Return_Date)->translatedFormat('j F Y');
        $loan->status = now()->lessThan(Carbon::parse($loan->Return_Date)) ? 'Dipinjam' : 'Terlambat';
    }

        return view('loans/loanlist', compact('loans'));
    }

    //untuk menampilkan form loan dengan data buku yang dipilih
    public function createLoan($book_id)
    {
        // Ambil data buku berdasarkan ID buku yang dipilih
        $books = Book::findOrFail($book_id);

        // Ambil semua anggota untuk dropdown atau pencarian
        $members = Member::all();

        return view('loans/loanformpage', compact('books','members'));
    }

    // Method untuk membuat ID loan baru
    private function generateLoanID()
    {
         // Ambil ID terakhir dari database
        $lastLoan = Loan::orderBy('ID_loan', 'desc')->first();
    
         // Jika ada data, buat ID baru berdasarkan ID terakhir, jika tidak, mulai dari L0001
         if ($lastLoan) {
            // Ambil nomor terakhir dari ID dan tambahkan 1
            $lastNumber = (int) Str::substr($lastLoan->ID_loan, 1);
            $newNumber = $lastNumber + 1;
    
            // Format dengan leading zeros
            return 'L' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
    
        // ID pertama jika tidak ada data di database
        return 'L0001';
    }

    // Method untuk menyimpan data loan
    public function storeLoan (Request $request)  
    {
         // Validasi input form
        $request->validate([
            'book_id' => 'required|string',
            'member_id' => 'required|string',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after:loan_date',
        ]);
        // Generate ID_loan
        $newLoanID = $this->generateLoanID();

            // Cari buku berdasarkan ID
        $book = Book::where('Book_ID', $request->book_id)->firstOrFail();

        // Cek ketersediaan buku
        if ($book->Copies_Available <= 0) {
            return redirect()->back()->withErrors('Buku ini tidak tersedia untuk dipinjam.');
        }

        //Simpan data peminjaman
        Loan::create([
            'ID_loan' => $newLoanID,
            'Book_ID' => $request->book_id,
            'Member_ID' => $request->member_id,
            'Loan_Date' => $request->loan_date,
            'Return_Date' => $request->return_date,
        ]);

        // Kurangi jumlah buku yang tersedia
        $book->Copies_Available -= 1;
        $book->save();

        return redirect()->route('loans')->with('success', 'Loan created successfully.');
    }

    public function returnBook($id)
    {
        // Cari peminjaman berdasarkan ID
        $loans = Loan::where('ID_loan', $id)->firstOrFail();

        // Cari buku berdasarkan ID dari peminjaman
        $book = Book::where('Book_ID', $loan->Book_ID)->firstOrFail();

        // Tambah jumlah buku yang tersedia
        $book->Copies_Available += 1;
        $book->save();

        // Hapus peminjaman
        $loans->delete();

        return redirect()->route('loans')->with('success', 'Buku berhasil dikembalikan.');
    }

}
