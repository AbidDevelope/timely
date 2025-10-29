<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class StockListController extends Controller
{
    public function getStockList()
    {
        try {
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
