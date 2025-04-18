<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category',
        'user_id',
        'amount',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
