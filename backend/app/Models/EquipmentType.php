<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentType extends Model
{
    use HasFactory, Filterable;

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    protected $fillable = [
        'name',
        'mask',
    ];
}
