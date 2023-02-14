<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'remarks','status','type','amount'
    ];
}
