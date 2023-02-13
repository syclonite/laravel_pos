<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name','phone_1','address','status','remarks'
    ];

    public function purchase_order(){
        return $this->hasMany(PurchaseOrder::class);
    }
}
