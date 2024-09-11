<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_return';
    protected $fillable = [
        'ID_return',
        'ID_loan',
        'Returns_date',
        'Shape'
    ];

     public function loan()
     {
         return $this->belongsTo(Loan::class, 'ID_loan', 'ID_loan');
     }
     //Model loan
    public function book()
    {
        return $this->belongsTo(Book::class, 'Book_ID', 'Book_ID');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'Member_ID', 'Member_ID');
    }
     
    public $incrementing = true;
    protected $keyType = 'string';

    public $timestamps = false;
}
