<?php

namespace App\Http\Controllers\User\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function attemptLogin(Request $request)
    {
        return
            auth()->attempt($this->credentials($request), $request->remember)
            || auth()->attempt([
                'username' => $request->email,
                'password' => $request->password
            ], false);
    }

    public function logout()
    {
        $user = auth()->guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->api_token_time = null;
            $user->refresh_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out'], 200);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json(['error' => "Too many login attempts"], 429);
        }

        if ($this->attemptLogin($request)) {
            $user = $request->user();

            return response()->json(
                array_merge(
                    $user->toArray(),
                    [
                        'api_token' => $user->generateToken(),
                        'refresh_token' => $user->generateRefreshToken(),
                        'points' => $user->points,
                        'allow_late' => ($user->group->current_competition) ? $user->group->current_competition->allow_late : "0",
                    ]
                )
            );
        }

        $this->incrementLoginAttempts($request);

        return response()->json(['error' => "Invalid Credentials"], 401);
    }

    public function refresh(Request $request)
    {
        $refresh_token = $request->refresh_token;
        $user = $request->user('api');

        if($user != null) {
            if (\Hash::check($refresh_token, $user->refresh_token)) {

                return response()->json(
                    array_merge(
                        $user->toArray(),
                        [
                            'api_token' => $user->generateToken(),
                            'points' => $user->points,
                            'allow_late' => ($user->group->current_competition) ? $user->group->current_competition->allow_late : "0",
                        ]
                    )
                );

            }
        }
        return response(["error" => "Invalid Refresh Token"], 401);
    }

    public function changePassword(Request $request)
    {
        $old_password = $request->old_password;
        $password = $request->password;
        $user = $this->guard()->user();
        if(\Hash::check($old_password, $user->password)) {
            $user->password = $password;
            $user->save();
            return response(null, 200);
        }
        return response(null, 400);
    }

    protected function guard()
    {
        return auth()->guard("api");
    }

    public function __construct()
    {
        $this->middleware('guest:api')->except(['logout', 'refresh']);
    }
}
