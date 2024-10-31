<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
    
            $user = User::where('facebook_id', $facebookUser->id)
                        ->where('email', $facebookUser->email)
                        ->first();
    
            if (!$user) {
                $nameParts = explode(' ', $facebookUser->name, 2);
                $firstname = $nameParts[0] ?? $facebookUser->name;
                $lastname = $nameParts[1] ?? '';
    
                $user = User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => bcrypt('your-secure-password'),
                ]);
    
                Auth::login($user);
                session()->flash('notify', ['success', 'Welcome, ' . $user->firstname . '! Your account has been created.']);
            } else {
                Auth::login($user);
                session()->flash('notify', ['success', 'Welcome back, ' . $user->firstname . '!']);
            }
    
            return redirect()->route('ego.index'); // Redirect to the intended route
    
        } catch (\Exception $e) {
            return redirect()->route('ego.login')->with('error', 'Failed to login with Facebook: ' . $e->getMessage());
        }
    }
    
}
