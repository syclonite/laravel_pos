<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','product_id','unit_id','total_quantity','currently_product_selling_price','status'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

}
