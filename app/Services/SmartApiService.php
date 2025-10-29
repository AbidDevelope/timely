<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class SmartApiService
{
    protected $baseUrl = "https://apiconnect.angelone.in/rest/secure/angelbroking/market/v1/quote/";
    protected $apiKey;
    protected $accessToken;

    public function __construct()
    {
        $this->apiKey = config('services.smartapi.api_key');
        $this->accessToken = session('angel_access_token');
    }


    public function getQuote($exchange, $token, $mode = 'FULL')
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-PrivateKey' => $this->apiKey,
            'X-SourceID' => 'WEB',
            'X-ClientLocalIP' => '127.0.0.1',
            'X-ClientPublicIP' => '127.0.0.1',
            'X-MACAddress' => 'ab:cd:ef:gh:ij',
            'X-UserType' => 'USER',
            'Authorization' => 'Bearer ' . session('angel_access_token'),
        ])->post($this->baseUrl, [
            'mode' => 'FULL',
            'exchangeTokens' => [
                'NSE' => ['3045'] 
            ]
        ]);


        return $response->json();
    }
}
