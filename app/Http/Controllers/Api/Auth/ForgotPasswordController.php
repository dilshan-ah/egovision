<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendResetCodeEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark' => 'validation_error',
                'status' => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $fieldType = $this->findFieldType();
        $user = User::where($fieldType, $request->value)->first();

        if (!$user) {
            $notify[] = 'Couldn\'t find any account with this information';
            return response()->json([
                'remark' => 'validation_error',
                'status' => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        notify($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ], ['email']);

        $email = $user->email;
        $response[] = 'Verification code sent to mail';
        return response()->json([
            'remark' => 'code_sent',
            'status' => 'success',
            'message' => ['success' => $response],
            'data' => [
                'email' => $email
            ]
        ]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required'
        ]);

        $code = str_replace(' ', '', $request->code);

        // Find the password reset entry
        $passwordReset = PasswordReset::where('token', $code)->where('email', $request->email)->first();

        if (!$passwordReset) {
            return response()->json([
                'status' => 'error',
                'message' => 'Verification code doesn\'t match'
            ], 400);
        }

        // Generate a new token (could reuse the same token, or generate a new one)
        $newToken = rand(100000, 999999);

        // Save this new token in session and use it in the reset password form
        session()->put('fpass_email', $request->email);
        session()->put('token', $newToken);

        // Update the PasswordReset token using email as the key
        PasswordReset::where('email', $request->email)->update(['token' => $newToken]);

        return response()->json([
            'status' => 'success',
            'message' => 'Code verified. Proceed to reset password.',
            'token' => $newToken // Return the new token so the app developer can redirect
        ], 200);
    }

    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }


        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if (!$reset) {
            $response[] = 'Invalid verification code.';
            return response()->json([
                'remark' => 'validation_error',
                'status' => 'error',
                'message' => ['success' => $response],
            ]);
        }

        $user = User::where('email', $reset->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();



        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        notify($user, 'PASS_RESET_DONE', [
            'operating_system' => @$userBrowser['os_platform'],
            'browser' => @$userBrowser['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ], ['email']);


        $response[] = 'Password changed successfully';
        return response()->json([
            'remark' => 'password_changed',
            'status' => 'success',
            'message' => ['success' => $response],
        ]);
    }

    protected function rules()
    {
        $passwordValidation = Password::min(6);
        $general = GeneralSetting::first();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', $passwordValidation],
        ];
    }

    private function findFieldType()
    {
        $input = request()->input('value');

        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $input]);
        return $fieldType;
    }
}
