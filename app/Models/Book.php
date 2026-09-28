<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 
        'isbn', 'stok', 'category_id', 'sampul'
    ];
}
