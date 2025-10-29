<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeRange extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'label', 'min_income', 'max_income'
    ];
}
