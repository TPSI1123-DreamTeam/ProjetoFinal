<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'type',
        'amount',
        'image'
    ];

    public function users(): BelongsToMany{

        return $this->belongsToMany(User::class);
    }

    public function suppliers(): BelongsToMany{

        return $this->belongsToMany(Supplier::class);
    }

    public function category(){  
        return $this->belongsTo(Category::class);
    }

    public function current_account(): HasOne
    {
        return $this->hasOne(CurrentAccount::class);
    }
}