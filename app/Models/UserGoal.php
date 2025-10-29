<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGoal extends Model
{
     protected $fillable = [
        'user_id', 'profession_id', 'income_range_id', 'payment_mode_id', 'age_group_id', 'plan_id', 'estimated_investment', 'monthly_savings'
    ];
}
