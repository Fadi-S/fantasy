<?php

namespace App\Http\Controllers\User\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, ['email' => 'required|email|exists:users']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = $this->validator($request->all());

        if($validator->fails())
            return response($validator->errors(), 404);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == \Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkResponse($response)
    {
        return response(["message" => "Reset Link sent to your email"]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response(["error" => ["Could not send email"]]);
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);
    }
}
