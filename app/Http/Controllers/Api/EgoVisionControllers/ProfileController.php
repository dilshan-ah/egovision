<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function submitPassword(Request $request, $userId)
    {
        $passwordValidation = Password::min(6);
        $general = gs();
        
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
    
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation],
        ]);
    
        // Check for validation failures
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422); // Unprocessable Entity
        }
    
        // Find the user
        $user = User::find($userId);
    
        // Check if user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404); // Not Found
        }
    
        // Check the current password
        if (Hash::check($request->current_password, $user->password)) {
            // Update the password
            $user->password = Hash::make($request->password);
            $user->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully'
            ], 200); // OK
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 401); // Unauthorized
        }
    }
    
}
