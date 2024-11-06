<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'confirmation'
    ];


    public function events(): BelongsToMany{

        return $this->belongsToMany(Event::class);
    }
}