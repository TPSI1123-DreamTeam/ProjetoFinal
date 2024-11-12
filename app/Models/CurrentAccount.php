<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CurrentAccount extends Model
{
    
    public function event(){  
        return $this->belongsTo(Event::class);
    }

    public function payments(): BelongsToMany{

        return $this->belongsToMany(Payment::class);
    }
}
