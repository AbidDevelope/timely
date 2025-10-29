<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Exception;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function professions()
    {
        try {
            $professions = Profession::all();
            return response()->json([
                'status' => true,
                'data' => $professions
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
