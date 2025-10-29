<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use Exception;
use Illuminate\Http\Request;

class AgeController extends Controller
{
    public function age()
    {
        try{
           $age = AgeGroup::all();
           return response()->json([
            'status' => true,
            'data' => $age
           ], 200);
        }catch(Exception $e){
          return response()->json([
            'status' => false,
            'error' => $e->getMessage()
          ], 500);
        }
    }
}
