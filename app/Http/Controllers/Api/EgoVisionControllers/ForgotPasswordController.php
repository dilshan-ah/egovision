<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ForgotPasswordController extends Controller
{
    public function sendResetCodeEmail(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);

        if (!verifyCaptcha()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid captcha provided'
            ], 422);
        }

        $fieldType = $this->findFieldType();
        $user = User::where($fieldType, $request->value)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Couldn\'t find any account with this information'
            ], 404);
        }

        PasswordReset::where('email', $user->email)->delete();

        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        // Notify user via email
        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        notify($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ], ['email']);

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset email sent successfully'
        ], 200);
    }
    

    public function findFieldType()
    {
        $input = request()->input('value');
        return filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }
}
