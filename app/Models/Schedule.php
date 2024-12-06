<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'order',
        'date',
        'time',     
        'title',     
        'description',   
    ];

    public function events(): BelongsToMany{

        return $this->belongsToMany(Event::class);
    }
}