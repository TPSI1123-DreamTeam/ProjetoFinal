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
        'description',
        'localization',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'type',
        'amount',
        'image',
        'category_id',
        'owner_id',
        'manager_id',
        'number_of_participants',
        'event_confirmation',
    ];

    protected $casts = [
        'owner_id'      => 'integer',
        'category_id'   => 'integer',
        //'start_time'    => 'date_format:Y-m-d H:i|after:now'
    ];

    public function users(): BelongsToMany{

        return $this->belongsToMany(User::class, 'event_user');
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
