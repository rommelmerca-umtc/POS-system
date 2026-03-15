<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'client_id',
        'sub_total',
        'grand_total',
        'vat',
        'service_charge',
        'payment_method',
        'payment_status',
        'payment_due',
        'status'
    ];

    protected $casts = [
        'sub_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'vat' => 'decimal:2',
        'service_charge' => 'decimal:2',
        'payment_due' => 'date',
    ];
}