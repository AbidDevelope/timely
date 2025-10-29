<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function plans()
    {
        try {
            $plans = Plan::with('ageGroup')->get();
            return response()->json([
                'status' => true,
                'data' => $plans
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
