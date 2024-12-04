<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'image',
        'date',
        'place',
        'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}


