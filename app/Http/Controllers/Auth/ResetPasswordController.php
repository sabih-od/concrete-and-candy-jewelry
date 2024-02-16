<?php

namespace App\Http\Controllers\Auth;

use App\Events\GenerateNotification;
use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not Found');
        }

        $user->password = Hash::make($password);
        $user->save();

        Auth::login($user);
        return redirect()->route('user.dashboard')->with('success', 'Password reset successfully.');

    }

    public function update(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|confirmed',
            ]);

            if ($validation->fails()) {
                return WebResponses::errorRedirectBack($validation->errors()->first());
            }

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'The current password is incorrect.');
            }

            $user->update(['password' => Hash::make($request->password)]);

            event(new GenerateNotification([
                'user_id' => $user->id,
                'notification' => 'Your password successfully updated',
            ]));

            return WebResponses::successRedirectBack('Password updated successfully.');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

}
