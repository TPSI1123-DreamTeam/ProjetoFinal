<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'stripe_id',
        'name',
        'amount',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'boolean',
    ];

    public function current_accounts(): BelongsToMany{

        return $this->belongsToMany(CurrentAccount::class);
    }



}
