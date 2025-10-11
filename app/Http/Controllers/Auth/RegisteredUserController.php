<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\OtpMail;

class RegisteredUserController extends Controller
{
    /**
     * Show registration form
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request (Step 1: generate + send OTP)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:Administrator (OIC),Admission Staff'], // <-- VALIDATE ROLE
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP to DB with 3 mins expiration
        Otp::create([
            'email' => $request->email,
            'otp_code' => $otp,
            'expires_at' => Carbon::now()->addMinutes(3),
        ]);

        // Send OTP via email
        Mail::to($request->email)->send(new OtpMail($otp));

        // Temporarily save user data in session (including role)
        session([
            'register_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role, // <-- STORE ROLE IN SESSION
            ],
        ]);

        return redirect()->route('verify.otp')->with('status', 'An OTP has been sent to your email. Please verify.');
    }

    /**
     * Show OTP verification form
     */
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    /**
     * Verify OTP and create account
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|numeric',
        ]);

        $data = session('register_data');

        if (!$data) {
            return redirect()->route('register')->withErrors(['error' => 'Session expired, please register again.']);
        }

        $otp = Otp::where('email', $data['email'])
                  ->where('otp_code', $request->otp_code)
                  ->first();

        if (!$otp) {
            return back()->withErrors(['otp_code' => 'Invalid OTP.']);
        }

        if (Carbon::now()->gt($otp->expires_at)) {
            return back()->withErrors(['otp_code' => 'OTP expired, please request again.']);
        }

        // Create user after OTP verification (include role)
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // <-- INCLUDE ROLE
            'email_verified_at' => now(), // ✅ MARK EMAIL AS VERIFIED
        ]);

        // Clear OTP + session
        $otp->delete();
        session()->forget('register_data');

        return redirect()->route('login')->with('status', 'Registration successful! You can now login.');
    }
}