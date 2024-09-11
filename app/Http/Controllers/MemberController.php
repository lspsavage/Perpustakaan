<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
  //Menampilkan daftar anggota
  public function memberpage (Request $request) 
  {
    // Ambil query pencarian
    $search = $request->input('search');

    $members = Member::when($search, function($query, $search) {
      return $query->where('Name', 'like', "%{$search}%")
                   ->orwhere('Email', 'like', "%{$search}%")
                   ->orwhere('Phone', 'like', "%{$search}%");
    })->get();

    return view('members/memberlistpage', compact('members'));
  }

  //Menampilkan detail anggota
  public function showmember($id)
  { 
    $members = Member::where('Member_ID', $id)->firstOrFail(); // Mengambil member berdasarkan id
    // Mengambil pinjaman yang terkait dengan anggota
    $loans = Loan::where('Member_ID', $id)
        ->with('book') // Pastikan relasi book di-load
        ->get();
       // Format tanggal menggunakan Carbon
       foreach ($loans as $loan) {
        $loan->formatted_loan_date = Carbon::parse($loan->Loan_Date)->translatedFormat('j F Y');
        $loan->formatted_return_date = Carbon::parse($loan->Return_Date)->translatedFormat('j F Y');
        $loan->status = now()->lessThan(Carbon::parse($loan->Return_Date)) ? 'Dipinjam' : 'Terlambat';
       }

    return view('members/memberdetail', compact('members','loans')); // Menampilkan halaman detail member
  }

  public function create()
  {
    return view('members/membercreate');
  }

     // Method untuk membuat ID Book baru
  private function generateMemberID()
    {
         // Ambil ID terakhir dari database
         $lastMember = Member::orderBy('Member_ID', 'desc')->first();
         // Jika ada data, buat ID baru berdasarkan ID terakhir, jika tidak, mulai dari B0001
         if ($lastMember) {
             // Ambil nomor terakhir dari ID dan tambahkan 1
             $lastNumber = (int) Str::substr($lastMember->Member_ID, 1);
             $newNumber = $lastNumber + 1;
             // Format dengan leading zeros
             return 'M' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
         }
         // ID pertama jika tidak ada data di database
         return 'M0001';
     }

   // Menyimpan data anggota baru
   public function store(Request $request)
   {
       // Validasi input
       $request->validate([
           'Name' => 'required|string',
           'Email' => 'required|email|unique:members',
           'Phone' => 'required|string',
           'Address' => 'required|string',
           'Membership_Date' => 'required|date',
       ]);

       // Generate ID Member baru
       $memberId = $this->generateMemberID();

       // Membuat anggota baru
       Member::create([
           'Member_ID' => $memberId,
           'Name' => $request->Name,
           'Email' => $request->Email,
           'Phone' => $request->Phone,
           'Address' => $request->Address,
           'Membership_Date' => $request->Membership_Date,
       ]);

       // Redirect ke halaman lain, misalnya ke daftar anggota
       return redirect()->route('members')->with('success', 'Anggota berhasil ditambahkan.');
   }

   public function edit($id)
   {
    $members = Member::where('Member_ID', $id)->firstOrFail();
    return view('members/memberupdate', compact('members'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
        'Name' => 'required|string',
        'Email' => 'required|email',
        'Phone' => 'required|string',
        'Address' => 'required|string',
        'Membership_Date' => 'required|date',
      ]);

      $members = Member::where('Member_ID', $id)->firstOrFail();
      $members->Name = $request->Name;
      $members->Email = $request->Email;
      $members->Phone = $request->Phone;
      $members->Address = $request->Address;
      $members->Membership_Date = $request->Membership_Date;
      $members->save();

      return redirect()->route('members.detail',['id' => $members->Member_ID])->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
      $member = Member::where('Member_ID', $id)->firstOrFail();
      
      // Hapus data anggota
      $member->delete();

      return redirect()->route('members')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->get('term');
        $members = Member::where('Name', 'LIKE', "%{$search}%")->get();
    
        return response()->json($members->map(function ($member) {
            return [
                'id' => $member->Member_ID,
                'label' => $member->Name,
                'value' => $member->Name,
            ];
        }));
    }
    

}
