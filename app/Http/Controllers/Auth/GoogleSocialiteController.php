<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
            dd(Socialite::driver('google'));
            $user = Socialite::driver('google')->user();

            $finduser = User::where('social_id', $user->id)->first();
            if ($finduser) {

                Auth::login($finduser);

                return redirect('/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => encrypt('my-google')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}