<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'source',
        'user_id',
        'description',
        'amount',
        'currency',
        'status',
        'tax_deducted',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
