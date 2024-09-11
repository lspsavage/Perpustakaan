<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnLog extends Model
{
    use HasFactory;

    protected $table = 'returnlogs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'old_ID_return',
        'book_title',
        'book_author',
        'member_name',
        'member_phone',
        'member_address',
        'loan_date',
        'return_date',
        'old_Returns_date',
        'old_Shape',
    ];

    public $timestamps = false; // Optional: jika Anda ingin menggunakan timestamps
}
