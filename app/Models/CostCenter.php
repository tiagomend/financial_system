<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'number',
        'name',
        'budget',
        'cost_center_type',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->number = (self::max('number') ?? 1000) + 1;
        });
    }
}
