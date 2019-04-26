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
    protected $redirectTo = '/home';

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

        if (!Auth::attempt($data)) {
            throw new AuthenticationException;
        }

        //nhan du lieu nguoi dung de login
        $user = User::where('email', '=', $data['email'])->first();
        $response = [];
        //user co ton tai
        if ($user) {  
            $response = $response = $passportService->personalAccessToken($request->user());
        }

        return new AuthResource($response, 'login');
    }
}
