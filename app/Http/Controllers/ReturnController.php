<?php

namespace App\Http\Controllers;

use App\Models\Returns;
use App\Models\Loan;
use App\Models\Book;
use App\Models\ReturnLog;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReturnController extends Controller
{
    //Menampilkan daftar anggota
    public function returnpage (Request $request) 
    {
        // Ambil query pencarian
        $search = $request->input('search');

        $returnlogs = ReturnLog::when($search, function ($query, $search) {
            return $query->where('book_title', 'like', "%{$search}%")
                         ->orwhere('member_name', 'like', "%{$search}%")
                         ->orwhere('loan_date', 'like', "%{$search}%")
                         ->orwhere('old_Returns_date', 'like', "%{$search}%")
                         ->orwhere('old_Shape', 'like', "%{$search}%");
        })->get();
        return view('loans.returnspage', compact('returnlogs'));

    }
    // Menampilkan formulir pengembalian berdasarkan ID pinjaman
    public function create($loan_id)
    {
        // Memanggil stored procedure
        $loanDetails = DB::select('CALL GetLoanDetails(?)', [$loan_id]);

        if (empty($loanDetails)) {
            return redirect()->route('returns')->with('error', 'Pinjaman tidak ditemukan.');
        }

        $loan = $loanDetails[0]; // Ambil data dari hasil query

        return view('loans/loanreturnform', compact('loan'));
    }
 
    // Memproses pengembalian buku
    public function store(Request $request)
    {
        $request->validate([
            'ID_loan' => 'required|string',
            'returns_date' => 'required|date',
            'shape' => 'required|string',
        ]);

        $loan = Loan::with('book', 'member')->find($request->ID_loan);

        if ($loan) {
            // Simpan log pengembalian
            DB::table('returnlogs')->insert([
                'id'=>$request->id,
                'old_ID_return' => $this->generateReturnID(),
                'book_title' => $loan->book->Title,
                'book_author' => $loan->book->Author,
                'member_name' => $loan->member->Name,
                'member_phone' => $loan->member->Phone,
                'member_address' => $loan->member->Address,
                'loan_date' => $loan->Loan_Date,
                'return_date' => $loan->Return_Date,
                'old_Returns_date' => $request->returns_date,
                'old_Shape' => $request->shape,
            ]);

            // Update jumlah buku yang tersedia
            $book = Book::find($loan->Book_ID);
            $book->Copies_Available += 1;
            $book->save();

            // Hapus record pinjaman setelah buku dikembalikan
            $loan->delete();

            return redirect()->route('loans')->with('success', 'Buku berhasil dikembalikan.');
        }

        return redirect()->route('loans')->with('error', 'Pinjaman tidak ditemukan.');
    }

    // Method untuk membuat ID return baru
    private function generateReturnID()
    {
        // Ambil ID terakhir dari database
        $lastReturn = Returns::orderBy('ID_return', 'desc')->first();

        // Jika ada data, buat ID baru berdasarkan ID terakhir, jika tidak, mulai dari R0001
        if ($lastReturn) {
            // Ambil nomor terakhir dari ID dan tambahkan 1
            $lastNumber = (int) Str::substr($lastReturn->ID_return, 1);
            $newNumber = $lastNumber + 1;

            // Format dengan leading zeros
            return 'R' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        // ID pertama jika tidak ada data di database
        return 'R0001';
    }

    public function showreturn ($id) 
    {
        $returnlogs = ReturnLog::findOrFail($id);
               // Format tanggal menggunakan Carbon
        $returnlogs->formatted_loan_date = Carbon::parse($returnlogs->loan_date)->translatedFormat('j F Y');
        $returnlogs->formatted_return_date = Carbon::parse($returnlogs->return_date)->translatedFormat('j F Y');
        $returnlogs->formatted_old_return_date = Carbon::parse($returnlogs->old_Returns_date)->translatedFormat('j F Y');

       return view('loans.detailreturn', compact('returnlogs'));
    }
}
