<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 
        'isbn', 'stok', 'category_id', 'sampul'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loansItem(): BelongsTo
    {
        return $this->belongsTo(LoanItem::class);
    }
}
