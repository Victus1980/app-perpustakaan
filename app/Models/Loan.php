<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    protected $fillable = [
        'member_id', 'user_id', 'tangal_pinjam', 'tanggal_kembali', 'tanggal_dikembalikan', 'status'
    ];
}
