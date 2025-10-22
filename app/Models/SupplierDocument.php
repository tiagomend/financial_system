<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierDocument extends Model
{
    protected $fillable = [
        'supplier_id',
        'document_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
