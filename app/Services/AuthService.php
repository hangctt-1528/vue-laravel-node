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

    public function personalAccessToken($user)
    {
        $config = config('common.api.personal_access_token');
        $token = $user->createToken($config['name']);
        $response = [
            'token_type' => $config['token_type'],
            'expires_at' => $token->token->expires_at,
            'access_token' => $token->accessToken,
        ];

        return $response;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
