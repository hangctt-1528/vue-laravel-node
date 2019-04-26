<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\AuthResource;
use App\Http\Requests\Auth\RefreshTokenRequest;
use Illuminate\Auth\AuthenticationException;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request, AuthService $passportService)
    {
        $data = $request->only(['email', 'password']);
        $response = $passportService->passwordGrantToken($data);

        return new AuthResource($response, 'login');
    }

    public function refreshToken(RefreshTokenRequest $request, AuthService $passportService)
    {
        $token = $request->refresh_token;
        $response = $passportService->refreshGrantToken($token);
        
        return new AuthResource($response, 'refreshToken');
    }
}
