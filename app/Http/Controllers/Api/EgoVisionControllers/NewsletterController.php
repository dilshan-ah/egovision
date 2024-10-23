<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store($userId)
    {
        try {
            $user = User::where('id', $userId)->first();

            if (!$user) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'User not found',
                    ],
                    404
                );
            }

            $userExist = User::where('id', $userId)->first();
            $existingsubscriber = Subscriber::where('email', $userExist->email)->first();

            if ($existingsubscriber) {
                $existingsubscriber->delete();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'You are unsubscribed',
                    ]
                );
            }else{
                $subscriber = new Subscriber();
                $subscriber->email = $user->email;
    
                $subscriber->save();
    
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'You are subscribed',
                    ]
                );
            }
            
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $th->getMessage(),
                ]
            );
        }
    }
}
