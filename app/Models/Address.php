<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'street_type',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'postal_code',
        'country'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function __toString()
    {
        $address = "{$this->street_type}. {$this->street}, {$this->number}";

        if (!empty($this->complement)) {
            $address .= ", {$this->complement}";
        }

        $address .= " - {$this->neighborhood}. CEP: {$this->postal_code}. ";
        $address .= "{$this->city} - {$this->state}.";

        return $address;
    }
}
