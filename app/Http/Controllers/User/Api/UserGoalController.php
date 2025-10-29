<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Models\AgeGroup;
use App\Models\IncomeRange;
use App\Models\Profession;
use App\Models\Plan;
use App\Models\PaymentMode;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\UserGoal;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Services\SmartApiService;

class UserGoalController extends Controller
{
    public function goalCalculate(Request $request, SmartApiService $smartApiService)
    {
        try {
            $validate = Validator::make($request->all(), [
                'profession' => 'required|string',
                'income_range' => 'required|array|min:2',
                'payment_mode' => 'required|string',
                'age_group' => 'required|array|min:2',
                'plan' => 'required|string',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 401);
            }

            $profession = Profession::where('name', $request->profession)->firstOrFail()->id;
            $incomeRange = IncomeRange::where('label', $request->income_range[0] . '-' . $request->income_range[1])->firstOrFail()->id;
            $paymentMode = PaymentMode::where('mode', $request->payment_mode)->firstOrFail()->id;
            $ageGroup = AgeGroup::with('plans')->where('label', $request->age_group[0] . '-' . $request->age_group[1])->firstOrFail();
            $planType = Plan::where('plan', $request->plan)->firstOrFail()->id;

            $validPlans = $ageGroup->plans->pluck('id')->toArray();
            if (!in_array($planType, $validPlans)) {
                return response()->json([
                    'status' => false,
                    'error' => 'Selected plan is not available for the given age group.'
                ], 400);
            }

            $incomeMin = $request->income_range[0];
            $incomeMax = $request->income_range[1];
            $income = ($incomeMin + $incomeMax) / 2 * 100000;

            $ageMin = $request->age_group[0];
            $ageMax = $request->age_group[1];
            $age = ($ageMin + $ageMax) / 2;

            // AI Estimate
            $apiKey = env('OPENROUTER_API_KEY');
            $estimatedInvestment = 0;
            $monthlySavings = 0;

            if (!empty($apiKey)) {
                $client = new Client();
                $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type' => 'application/json',
                        'HTTP-Referer' => 'http://localhost:8000/',
                    ],
                    'json' => [
                        'model' => 'openrouter/auto',
                        'messages' => [
                            [
                                'role' => 'user',
                                'content' => "Calculate investment for profession: {$request->profession}, income range: {$income} INR, age: {$age}, payment mode: {$request->payment_mode}, plan: {$request->plan}. Suggest estimated investment and monthly savings for 3 years with 10% growth. Return in format: 'Estimated Investment: X, Monthly Savings: Y' where X and Y are numbers."
                            ]
                        ],
                        'max_tokens' => 100,
                    ],
                ]);

                $aiResponse = json_decode($response->getBody(), true);
                $aiText = $aiResponse['choices'][0]['message']['content'] ?? '';

                preg_match('/Estimated Investment: (\d+\.?\d*)/', $aiText, $investmentMatch);
                preg_match('/Monthly Savings: (\d+\.?\d*)/', $aiText, $savingsMatch);

                $estimatedInvestment = isset($investmentMatch[1]) ? floatval($investmentMatch[1]) : 0;
                $monthlySavings = isset($savingsMatch[1]) ? floatval($savingsMatch[1]) : 0;
            }

            // Fallback if AI failed
            if ($estimatedInvestment == 0 || $monthlySavings == 0) {
                $professionWeight = $this->getProfessionWeight($profession);
                $ageWeight = $this->getAgeWeight($age);
                $planWeight = $this->getPlanWeight($planType);
                $paymentWeight = $this->getPaymentWeight($paymentMode);

                $baseInvestment = $income * ($professionWeight * $ageWeight * $planWeight * $paymentWeight) * 0.3;
                $growthFactor = 0.1;
                $estimatedInvestment = $baseInvestment * (1 + $growthFactor * 3);
                $monthlySavings = $estimatedInvestment / 36;
            }

            // Save user goal
            $goal = UserGoal::create([
                'user_id' => JWTAuth::user()->id,
                'profession_id' => $profession,
                'income_range_id' => $incomeRange,
                'payment_mode_id' => $paymentMode,
                'age_group_id' => $ageGroup->id,
                'plan_id' => $planType,
                'estimated_investment' => $estimatedInvestment,
                'monthly_savings' => $monthlySavings
            ]);

            $exchange = 'NSE';
            $token = '3045';

            $data = $smartApiService->getQuote($exchange, $token);



            return response()->json([
                'status' => true,
                'message' => 'Goal calculated and stock suggestions fetched.',
                'data' => $goal,
                'recommended_stocks' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function getProfessionWeight($professionId)
    {
        $weights = [
            '1' => 1.2,
            '2' => 1.3,
            '3' => 1.0,
            '4' => 1.4,
        ];
        return $weights[$professionId] ?? 1.0;
    }

    private function getAgeWeight($age)
    {
        if ($age <= 30) return 1.5;
        elseif ($age <= 40) return 1.2;
        else return 1.0;
    }

    private function getPlanWeight($planTypeId)
    {
        $weights = [
            '1' => 1.3,
            '2' => 1.2,
            '3' => 1.1,
            '4' => 1.0,
        ];
        return $weights[$planTypeId] ?? 1.0;
    }

    private function getPaymentWeight($paymentModeId)
    {
        $weights = [
            '1' => 1.1,
            '2' => 1.0,
            '3' => 0.9,
        ];
        return $weights[$paymentModeId] ?? 1.0;
    }
}
