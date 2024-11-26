<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class SupplierType extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function supplier(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
    
}


