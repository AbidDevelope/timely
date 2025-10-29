<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AgeGroup;

class Plan extends Model
{
    protected $fillable = [
        'age_group_id', 'plan'
    ];

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }
}
