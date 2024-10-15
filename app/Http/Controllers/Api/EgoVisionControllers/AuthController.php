<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'firstname' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',
    //         'username' => 'required|string|unique:users',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $user = new User;
    //     $user->firstname = $request->firstname;
    //     $user->lastname = $request->lastname;
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     $token = $user->createToken('MyApp')->plainTextToken;

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User registered successfully.',
    //         'data' => [
    //             'user' => [
    //                 'id' => $user->id,
    //                 'firstname' => $user->firstname,
    //                 'lastname' => $user->lastname,
    //                 'username' => $user->username,
    //                 'email' => $user->email,
    //             ],
    //             'token' => $token,
    //         ]
    //     ], 201);
    // }

    public function egoPostRegister(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'location' => 'nullable',
        ]);

        try {
            // Create a new user
            $user = new User();
            $user->firstname = $validatedData['firstname'];
            $user->lastname = $validatedData['lastname'];
            $user->dob = $validatedData['dob'];
            $user->mobile = $validatedData['mobile'];
            $user->location = $validatedData['location'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            if ($request->has('newsletter')) {
                $subscriber = new Subscriber();

                $subscriber->email = $user->email;
                $subscriber->save();
            }

            $user->ver_code = verificationCode(6); // Generate a 6-digit verification code
            $user->ver_code_send_at = Carbon::now();
            $user->save();

            // Send email verification notification
            notify($user, 'EVER_CODE', [
                'code' => $user->ver_code
            ], ['email']);

            // Return a successful response
            return response()->json([
                'success' => true,
                'message' => 'Account created successfully!',
                'data' => $user,
                'ver_code' => $user->ver_code
            ], 201);

        } catch (\Exception $e) {
            // Return an error response in case of failure
            return response()->json([
                'success' => false,
                'message' => 'Account creation failed.',
                'error' => $e->getMessage(),
            ], 500); // 500 for server error
        }
    }


    public function getDistricts()
    {
        $response = Http::withOptions([
            'verify' => realpath('C:\\xampp\\php\\extras\\ssl\\cacert.pem')
        ])->get('https://countriesnow.space/api/v0.1/countries/states');

        $data = $response->json();
        $states = $data['data'][18];

        return response()->json($states);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;

            $data = [
                'user' => [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'email_verified' => $user->ev
                ],
                'token' => $token,
                'token_type' => 'Bearer',
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'errors' => ['Unauthorized' => 'Invalid email or password']
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.'
        ], 200);
    }
}
