<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    public function loans():HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
