<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRecordDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id','expense_record_id','status','amount'
    ];
}
