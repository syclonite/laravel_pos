<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','user_id','sale_order_id','product_id','unit_id','quantity',
        'product_selling_price','status','discount','extra_charge'];

}
