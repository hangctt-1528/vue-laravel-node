<?php

namespace App\Services;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthService extends AppService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function passwordGrantToken(array $input, $scope = '')
    {
        $response = $this->client->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
                'username' => $input['email'],
                'password' => $input['password'],
                'scope' => $scope,
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }
    
    public function refreshGrantToken($refreshToken)
    {
        $response = $this->client->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }
}
