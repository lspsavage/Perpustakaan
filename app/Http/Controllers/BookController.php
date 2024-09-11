<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
  //Menampilkan daftar buku
  public function bookspage(Request $request)
  {
    // Ambil query pencarian
    $search = $request->input('search');

    $books = Book::when($search, function ($query, $search) {
      return $query->where('Title', 'like', "%{$search}%")
                   ->orwhere('Author', 'like', "%{$search}%")
                   ->orwhere('Publisher', 'like', "%{$search}%")
                   ->orwhere('Genre', 'like', "%{$search}%");
    })->get();

    return view('books/bookspage', compact('books'));
  }

  // Menampilkan detail buku
  public function show($id)
  {
      $books = Book::where('Book_ID', $id)->firstOrFail(); // Mengambil buku berdasarkan id
      return view('books/booksdetailpage', compact('books')); // Menampilkan halaman detail buku
  }

  public function create()
  {
    return view('books/bookscreate');
  }

   // Method untuk membuat ID Book baru
   private function generateBookID()
   {
       // Ambil ID terakhir dari database
       $lastBook = Book::orderBy('Book_ID', 'desc')->first();
       // Jika ada data, buat ID baru berdasarkan ID terakhir, jika tidak, mulai dari B0001
       if ($lastBook) {
           // Ambil nomor terakhir dari ID dan tambahkan 1
           $lastNumber = (int) Str::substr($lastBook->Book_ID, 1);
           $newNumber = $lastNumber + 1;
           // Format dengan leading zeros
           return 'B' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
       }
       // ID pertama jika tidak ada data di database
       return 'B0001';
   }

  public function bookstore(Request $request)
  {
     $request->validate([
      'Title' => 'required|string',
      'Author' => 'required|string',
      'Publisher' => 'required|string',
      'Year_Published' => 'required|integer',
      'Genre' => 'required|string',
      'ISBN' => 'required|string',
      'Copies_Available' => 'required|integer',
      'Pict' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
     ]);
     // Buat ID Buku baru
     $bookID = $this->generateBookID();

     // Simpan gambar jika ada
    if ($request->hasFile('Pict')) {
    // Simpan gambar di folder public/images
        $imageName = time() . '_' . $request->file('Pict')->getClientOriginalName();
        $request->file('Pict')->move(public_path('images'), $imageName);
      } else {
        $imageName = null;
      }

     //Buat buku baru
     Book::create([
      'Book_ID' => $bookID,
      'Title' => $request->Title,
      'Author' => $request->Author,
      'Publisher' => $request->Publisher,
      'Year_Published' => $request->Year_Published,
      'Genre' => $request->Genre,
      'ISBN' => $request->ISBN,
      'Copies_Available' => $request->Copies_Available,
      'Pict' => $imageName,
     ]);

     return redirect()->route('books')->with('success', 'Book added successfully.');
  }

  public function destroy($id)
{
    // Temukan buku berdasarkan ID
    $books = Book::where('Book_ID', $id)->firstOrFail();

    // Hapus gambar dari folder public/images jika ada
    if ($books->Pict && file_exists(public_path('images/' . $books->Pict))) {
        unlink(public_path('images/' . $books->Pict));
    }

    // Hapus buku dari database
    $books->delete();

    return redirect()->route('books')->with('success', 'Buku berhasil dihapus.');
}

  public function edit($id)
  {
      $books = Book::where('Book_ID', $id)->firstOrFail();
      return view('books/booksupdate', compact('books'));
  }

  public function update(Request $request, $id)
  {
      $books = Book::where('Book_ID', $id)->firstOrFail();

      $request->validate([
          'Title' => 'required|string',
          'Author' => 'required|string',
          'Publisher' => 'required|string',
          'Year_Published' => 'required|integer',
          'Genre' => 'required|string',
          'ISBN' => 'required|string',
          'Copies_Available' => 'required|integer',
          'Pict' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);

      // Handle Image Upload
      if ($request->hasFile('Pict')) {
          // Hapus gambar lama jika ada
          if ($books->Pict && file_exists(public_path('images/' . $books->Pict))) {
              unlink(public_path('images/' . $books->Pict));
          }

          // Simpan gambar baru
          $imageName = time() . '.' . $request->Pict->extension();
          $request->Pict->move(public_path('images'), $imageName);
          $books->Pict = $imageName;
      }

      // Update other fields
      $books->Title = $request->Title;
      $books->Author = $request->Author;
      $books->Publisher = $request->Publisher;
      $books->Year_Published = $request->Year_Published;
      $books->Genre = $request->Genre;
      $books->ISBN = $request->ISBN;
      $books->Copies_Available = $request->Copies_Available;
      
      $books->save();

      return redirect()->route('books.detail', ['id' => $books->Book_ID])->with('success', 'Data buku berhasil diperbarui.');
  }

}
