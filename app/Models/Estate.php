<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estate extends Model
{
    protected $fillable = [
        'supervisor_user_id',
        'user_shift_id',
        'street',
        'building_number',
        'city',
        'zip',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'supervisor_user_id');
    }
}
