<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    // এই ২টা Accessor যোগ করো (সবচেয়ে গুরুত্বপূর্ণ)
    public function getTotalBillsAttribute()
    {
        return $this->bills_count ?? 0;
    }

    public function getTotalAmountAttribute()
    {
        return $this->bills_sum_grand_total ?? 0;
    }
}
