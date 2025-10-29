<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMode;
use Exception;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
    public function paymentMode()
    {
        try{
          $mode = PaymentMode::all();
          return response()->json([
            'status' => true,
            'data' => $mode
          ], 200);
        }catch(Exception $e)
        {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
