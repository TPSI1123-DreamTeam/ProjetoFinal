<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'email',
    ];

    public function events(): BelongsToMany{

        return $this->belongsToMany(Event::class);
    }

    public function supplierType(): HasOne
    {
        return $this->hasOne(SupplierType::class);
    }

}
