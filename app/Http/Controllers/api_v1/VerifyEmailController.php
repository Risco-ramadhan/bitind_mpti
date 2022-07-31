<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailCode;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {

        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Email already successfully',
            ]);
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Email Verified successfully',
        ]);
    }

    public function verifyEmailWithCode(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id'    => 'required|numeric|digits_between:1,2',
                'email_code' => 'required|numeric|digits:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Verification Error',
                    'data' => $validator->errors(),
                    'errorCode' => 422
                ],
                422
            );
        }

        $user = User::find($request->id);

        if ($user->email_code_verify == $request->email_code) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
            return response()->json(
                [
                    'status' => 'success',
                    'data' => null,
                    'message' => 'Email verifiedd Successfully',
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => 'Verification Code Error',
                    'data' => $validator->errors(),
                    'errorCode' => 422
                ],
                422
            );
        }
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'message'=>'Email has been verified'
        ];
    }

    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'Failed',
                'data' => null,
                'message' => 'Email already verified',
            ]);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Resend Email successfully',
        ]);
    }
    
}
