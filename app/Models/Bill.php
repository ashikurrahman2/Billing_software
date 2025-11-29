<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'invoice_no', 'customer_id', 'date', 'subtotal', 'vat',
        'discount', 'grand_total', 'payment_method', 'status', 'note'
    ];

    protected $casts = ['date' => 'date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(BillItem::class);
    }
}
