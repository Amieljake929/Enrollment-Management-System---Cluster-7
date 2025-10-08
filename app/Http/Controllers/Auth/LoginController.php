<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\LoginOtp;
use App\Mail\OtpMail;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login and manage MFA OTP
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // --- Auto-delete expired OTPs ---
        LoginOtp::where('expires_at', '<', Carbon::now())->delete();
        // --------------------------------

        // Check last unused OTP that is not expired
        $lastOtp = LoginOtp::where('user_id', $user->id)
                    ->where('used', false)
                    ->where('expires_at', '>=', Carbon::now())
                    ->orderBy('created_at', 'desc')
                    ->first();

        if ($lastOtp) {
            // Reuse existing OTP (still valid)
            $otp = $lastOtp->otp_code;
        } else {
            // Generate new OTP
            $otp = rand(100000, 999999);

            LoginOtp::create([
                'user_id' => $user->id,
                'otp_code' => $otp,
                'expires_at' => Carbon::now()->addMinutes(30),
                'used' => false,
            ]);
        }

        // Send OTP via email
        Mail::to($user->email)->send(new OtpMail($otp));

        // Save user id in session temporarily
        session(['mfa_user_id' => $user->id]);

        return redirect()->route('mfa.form');
    }

    /**
     * Show the MFA verification form
     */
    public function showMfaForm()
    {
        return view('auth.mfa');
    }

    /**
 * Verify MFA code and log in user
 */
public function verifyMfa(Request $request)
{
    $request->validate([
        'otp_code' => 'required|numeric',
    ]);

    $userId = session('mfa_user_id');

    if (!$userId) {
        return redirect()->route('login')->withErrors(['error' => 'Session expired, login again.']);
    }

    // Verify OTP
    $otp = LoginOtp::where('user_id', $userId)
                  ->where('otp_code', $request->otp_code)
                  ->where('used', false)
                  ->where('expires_at', '>=', Carbon::now())
                  ->first();

    if (!$otp) {
        return back()->withErrors(['otp_code' => 'Invalid or expired OTP']);
    }

    // Login the user
    Auth::loginUsingId($userId);

    // Enforce single session: delete other sessions for this user
    $deletedSessions = DB::table('sessions')->where('user_id', $userId)->where('id', '!=', session()->getId())->delete();

    // Mark OTP as used
    $otp->update(['used' => true]);
    session()->forget('mfa_user_id');

    // 🚀 SET FLAG FOR MODAL TRIGGER
    session(['just_logged_in' => true]);

    // 🚀 REDIRECT BASED ON ROLE
    $user = Auth::user();

    $redirect = redirect('/dashboard'); // default

    if ($user->role === 'Administrator (OIC)') {
        $redirect = redirect()->intended('/dashboard');
    } elseif ($user->role === 'Staff OIC') {
        $redirect = redirect()->intended('/dashboard-staff');
    }

    // If other sessions were deleted, show message
    if ($deletedSessions > 0) {
        $redirect = $redirect->with('message', 'You have logged in from another device. Previous sessions have been invalidated.');
    }

    return $redirect;
}
}