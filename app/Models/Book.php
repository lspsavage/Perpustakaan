<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'Book_ID';
    protected $fillable = [
        'Book_ID',
        'Title',
        'Author',
        'Publisher',
        'Year_Published',
        'Genre',
        'ISBN',
        'Copies_Available',
        'Pict'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'Member_ID', 'Member_ID');
    }
    
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
}
