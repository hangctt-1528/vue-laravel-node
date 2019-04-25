<?php

namespace App\Http\Controllers;

use Auth;
use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterFormRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password
        ];
       
        $result = $this->service->store($data);
        
        return new UserResource($result, __FUNCTION__);
     }
}
