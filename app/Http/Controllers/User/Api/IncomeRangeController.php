<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeRange;
use Exception;
use Illuminate\Http\Request;

class IncomeRangeController extends Controller
{
    public function incomeRange()
    {
        try{
          $incomeRange = IncomeRange::all();

          return response()->json([
            'status' => true,
            'data' => $incomeRange
          ], 200);
        }catch(Exception $e)
        {
          return response()->json([
            'status' => false,
            'error' => $e->getMessage()
          ], 500);
        }
    }
}
