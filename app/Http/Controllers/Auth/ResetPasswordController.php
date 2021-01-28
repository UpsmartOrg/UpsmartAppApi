<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    protected function resetPassword(Request $request)
    {
        $user = User::where('id', $request->user)->first();

        if(Hash::check($request->oldPassword, $user->password)){
            $user->password = Hash::make($request->newPassword);
            $user->save();
            event(new PasswordReset($user));
            return response($user, 200);
        }

        $response = ["message" =>'Wachtwoord wijzigen mislukt. Onjuist wachtwoord.'];
        return response($response, 422);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        $response = ['message' => "Password reset successful"];
        return response($response, 200);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        $response = "Token Invalid";
        return response($response, 401);
    }
}
