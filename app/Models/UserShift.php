<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserShift extends Model
{
    protected $fillable = [
        'user_id',
        'substitute_user_id',
        'temp_changes',
        'date_from',
        'date_to',
    ];

    protected $casts = [
        'temp_changes' => 'array'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function substituteUser(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'substitute_user_id');
    }

    public function estates(): HasMany
    {
        return $this->hasMany(Estate::class, 'supervisor_user_id', 'user_id');
    }
}
