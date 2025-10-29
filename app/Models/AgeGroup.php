<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Plan;

class AgeGroup extends Model
{
    use SoftDeletes;
    protected $fillable = [
       'label', 'min_age', 'max_age'
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
