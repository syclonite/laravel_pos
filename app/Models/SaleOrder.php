<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','user_id','billing_amount','paid_amount','status','discount','extra_charge'];

}
