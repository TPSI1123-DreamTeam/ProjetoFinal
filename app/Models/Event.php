<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'services_default_array'
    ];

    protected $casts = [
        'owner_id'      => 'integer',
        'category_id'   => 'integer',

    ];

    public function users(): BelongsToMany{

        return $this->belongsToMany(User::class,'event_user')->withPivot('confirmation');
    }

    public function suppliers(): BelongsToMany{

        return $this->belongsToMany(Supplier::class,'event_supplier')->withPivot('id','description','amount');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function current_account(): HasOne
    {
        return $this->hasOne(CurrentAccount::class);
    }

    public function invitation(): HasOne
    {
        return $this->hasOne(invitation::class);
    }

    public function schedules(): BelongsToMany{

        return $this->belongsToMany(Schedule::class,'event_schedule')->withPivot('id');
    }

    
    public function ticketPayments()
    {
        return $this->hasMany(Payment::class)
                    ->where('type', 'ticket')
                    ->where('status', 1);
    }

}
