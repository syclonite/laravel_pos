<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_name','product_description','status','subcategory_id',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
