<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
    
    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->where('email',$google_user->getEmail())->first();
    
            if (!$user) {
                $new_user = User::create([
                    'firstname' => $google_user->user['given_name'],
                    'lastname' => $google_user->user['family_name'],
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'ev' => $google_user->user['email_verified'],
                ]);
    
                Auth::login($new_user);
    
                session()->flash('notify', ['success', 'Welcome, ' . $new_user->name . '! Your account has been created.']);
            } else {
                Auth::login($user);
    
                session()->flash('notify', ['success', 'Welcome back, ' . $user->name . '!']);
            }
    
            return redirect('/');
    
        } catch (\Throwable $th) {
            session()->flash('notify', ['error', 'Something went wrong: ' . $th->getMessage()]);
    
            return redirect()->back();
        }
    }
}
