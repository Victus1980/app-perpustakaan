<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
