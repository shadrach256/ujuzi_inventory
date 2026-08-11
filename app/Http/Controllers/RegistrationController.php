<?php

namespace App\Http\Controllers;

use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        OtpCode::create([
            'email' => $request->email,
            'otp_code' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Verify Your Email');
        });

        \Log::info('OTP Code', ['email' => $request->email, 'otp' => $otp]);

        session([
            'otp_email' => $request->email,
            'registration_data' => $request->only('name', 'email', 'password')
        ]);

        return redirect()->route('otp.verify')->with('success', 'OTP sent to your email.');
    }

    public function showOtpForm()
    {
        if (!session('otp_email')) {
            return redirect()->route('register');
        }

        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:4',
        ]);

        $otpRecord = OtpCode::where('email', session('otp_email'))
            ->where('otp_code', $request->otp)
            ->latest()
            ->first();

        if (!$otpRecord || !$otpRecord->isValid()) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        $data = session('registration_data');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        OtpCode::where('email', $data['email'])->delete();

        session()->forget(['otp_email', 'registration_data']);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}