<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class OtpService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function generateOtp(User $user)
    {
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(2);
        $user->save();
        Cache::put('otp_user' . $user->mobile, $user->id, 300);

        return $otp;
    }

    public function verifyOtp(User $user, $otp)
    {
        if ($user->otp == $otp && now()->lt($user->otp_expires_at)) {
            $user->update([
                'otp_expires_at' => now(),
                'otp' => null,
            ]);
            return true;
        }

        if ($user->otp == $otp && now()->lt($user->email_verified_at)) {
                $user->update(attributes: [
                    'email_verified_at' => now(),
                    'otp' => null,
                ]);
                return true;
            }
        return false;
    }
}
