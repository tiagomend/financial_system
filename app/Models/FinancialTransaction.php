<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'transaction_type',
        'description',
        'due_date',
        'amount',
        'recipient_id',
        'expense_category_id',
        'recipient_type'
    ];
}
