<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'user_firstname',
        'user_lastname',
    ];

    public function estate(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }
}
