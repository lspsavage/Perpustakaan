<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_loan';
    protected $fillable = [
        'ID_loan',
        'Book_ID',
        'Member_ID',
        'Loan_Date',
        'Return_Date'
    ];

     // Relasi ke model Book
     public function book()
     {
         return $this->belongsTo(Book::class, 'Book_ID', 'Book_ID');
     }
 
     // Relasi ke model Member (jika diperlukan)
     public function member()
     {
         return $this->belongsTo(Member::class, 'Member_ID', 'Member_ID');
     }
     
    public $incrementing = true;
    protected $keyType = 'string';

    public $timestamps = false;
}
