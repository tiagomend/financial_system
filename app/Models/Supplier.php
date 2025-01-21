<?php

namespace App\Models;

use App\Enums\PersonType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $fillable = [
        'name',
        'trade_name',
        'person_type',
    ];

    protected function personType(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value instanceof PersonType ? $value : PersonType::from($value),
        );
    }
}
