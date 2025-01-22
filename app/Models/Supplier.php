<?php

namespace App\Models;

use App\Enums\PersonType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'trade_name',
        'person_type',
        'document'
    ];

    protected function personType(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value instanceof PersonType ? $value : PersonType::from($value),
        );
    }

    public function documents()
    {
        return $this->hasManyThrough(
            Document::class,
            SupplierDocument::class,
            'supplier_id',
            'id',
            'id',
            'document_id'
        );
    }
}
