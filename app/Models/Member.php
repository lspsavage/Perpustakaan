<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = 'Member_ID';
    protected $fillable = [
        'Member_ID',
        'Name',
        'Email',
        'Phone',
        'Address',
        'Membership_Date'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'Member_ID', 'Member_ID');
    }
    
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
}
