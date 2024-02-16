<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\PHPCustomMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails, PHPCustomMail;

    public function forgetPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                Rule::exists('users', 'email'),
            ],
        ]);

        $email = $request->input('email');
        $token = Str::random(64);

        $user = User::where('email', $email)->first();
        $user->update(['password' => $token]);
        $user->save();

        $to = $email;
        $from = 'noreply@candy-jewelry.com';
        $subject = "Reset Password";
        $verifyLink = route('password.reset');

        $form = '';
        $form .= '<h3>Dear ' . $user->name . ',</h3>';
        $form .= '<a href="' . $verifyLink . '" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">';
        $form .= 'Click Here ';
        $form .= '</a>';
        $form .= '<p>to reset your password.</p>';
        $this->customMail($from, $to, $subject, $form);

        return redirect()->back()->with('success', 'Password recovery mail sent successfully.');
    }

}
