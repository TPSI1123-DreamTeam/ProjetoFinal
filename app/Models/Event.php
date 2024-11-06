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

    public function participants(): BelongsToMany{

        return $this->belongsToMany(Participant::class);
    }

}