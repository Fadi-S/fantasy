<?php

namespace App\Http\Controllers\User\API\Auth;

use App\Http\Helpers\Slug;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Year\Year;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '';

    public function __construct()
    {
        $this->middleware('guest:api');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        $validator->after(function ($validator) use($request) {
            if(count(explode(" ", $request->name)) < 2)
                $validator->errors()->add('name', 'You must write your First and Last name');
        });

        if($validator->fails())
            return response($validator->errors(), 409);

        event(new Registered($user = $this->create($request->all())));

        return response()->json(
            array_merge(
                $user->toArray(),
                [
                    'api_token' => $user->generateToken(),
                    'refresh_token' => $user->generateRefreshToken(),
                    'points' => $user->points,
                ]
            )
        );
    }

    protected function create(array $data)
    {
        $year = Year::with("group")->where("id", $data["year_id"])->first();
        if($year == null) $year = Year::first();

        return User::create([
            'name' => $data['name'],
            'username' => Slug::createSlug(User::class, ".", $data["name"], "username"),
            'email' => $data['email'],
            'group_id' => $year->group->id,
            'year_id' => $data["year_id"],
            'password' => $data['password'],
        ]);
    }

    protected function guard()
    {
        return \Auth::guard("api");
    }

}
