<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Services\OtpService;
use Exception;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function register(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string',
                'mobile' => 'required|digits:10|unique:users,mobile',
                'email' => 'required|string|unique:users,email',
                'dob' => 'required|string',
                'password' => 'required|string|min:6'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'dob' => $request->dob,
                'password' => Hash::make($request->password),
            ]);

            $otp = $this->otpService->generateOtp($user);

            return response()->json([
                'status' => true,
                'message' => "OTP sent to your mobile number:{ $user->mobile }",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'mobile' => 'required|digits:10',
                'otp' => 'required|digits:4',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::where('mobile', $request->mobile)->first();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $isValidOtp = $this->otpService->verifyOtp($user, $request->otp);

            if (!$isValidOtp) {
                return response()->json(['message' => 'Invalid or expired OTP'], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully',
                'token' => JWTAuth::fromUser($user),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function login(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Credentials'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'user login successfully',
                'user' => JWTAuth::user(),
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'email not exists'
                ], 404);
            }

            $otp = $this->otpService->generateOtp($user);

            $mailData = [
                'title' => 'Mail from timely.com',
                'body' => 'This is for testing email using smtp.',
                'otp' => $otp
            ];
            Mail::to('abid.ttsit@gmail.com')->send(new UserMail($mailData));

            return response()->json([
                'status' => true,
                'message' => 'otp sent successfully on your email',
                'email' => $user->email,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function emailVerify(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required',
                'otp' => 'required|digits:4'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'email not exists'
                ], 404);
            }

            // $request->merge(['email' => $request->email]);
            $isValidOtp = $this->otpService->verifyOtp($user, $request->otp);
            if (!$isValidOtp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expire otp'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'otp verify successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|exists:users,email',
                'password' => 'required|min:6|string|confirmed',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password reset successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
             $validate = Validator::make($request->all(), [
                'email' => 'required|exists:users,email',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                if (!$user) {
                    return response()->json([
                        'status' => false,
                        'message' => 'email not exists'
                    ], 404);
                }
            }
            $otp = $this->otpService->generateOtp($user);
            $mailData = [
                'title' => 'Mail from timely.com',
                'body' => 'This is for testing email using smtp.',
                'otp' => $otp
            ];
            Mail::to('abid.ttsit@gmail.com')->send(new UserMail($mailData));

            return response()->json([
                'status' => true,
                'message' => 'otp resend successfully',
                'email' => $user->email,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
