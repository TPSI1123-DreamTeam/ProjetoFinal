<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'email',
        'supplier_type_id',
        'status',
    ];

    public function events(): BelongsToMany{

        return $this->belongsToMany(Event::class);
    }

    public function supplierType(): BelongsTo
    {
        return $this->belongsTo(SupplierType::class);
    }

}
