<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_name',
        'unit_description',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
