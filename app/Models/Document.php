<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['type', 'value'];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_documents', 'document_id', 'supplier_id');
    }
}
