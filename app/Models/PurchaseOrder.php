<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id','user_id','billing_amount','paid_amount','status'
    ];

    public function purchase_order_details(){
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function supplier(){
        return $this->belongsTo(Suppliers::class);
    }

}
