<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Github authentication page
     *
     * @return Response
     */
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Github
     *
     * @return Response
     */
    public function handleProviderCallback($provider) 
    {
        $user = Socialite::driver($provider)->user();
        $createdUser = User::firstOrCreate([
            'provider' => $provider,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'provider_id' => $user->getId(),
        ]);
        
        // Login với user vừa tạo.
        Auth::login($createdUser);

        return redirect('/home');
    }
}
