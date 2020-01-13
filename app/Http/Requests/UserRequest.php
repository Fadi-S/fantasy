<?php

namespace App\Http\Requests;

use App\Http\Helpers\Slug;
use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == "PATCH") {
            $rules = [
                'name' => "required",
                'username' => Rule::unique('users')->ignore($this->route("user")->id),
                'password' => "nullable|min:6",
                "group_id" => "required|notIn:0|numeric",
                'email' => [
                        "required",
                        "email",
                        Rule::unique('users')->ignore($this->route("user")->id)
                    ],
            ];
        }else {
            $rules = [
                'name' => "required",
                'username' => "required|unique:users",
                'email' => "required|email|unique:users",
                'password' => "required|min:6",
                "group_id" => "required|notIn:0|numeric",
            ];
        }

        return $rules;
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        if($this->method() == "POST") {
            $data['username'] = Slug::createSlug(User::class, ".", $this->name, "username");
            if($this->password == '')
                $data['password'] = Str::random(6);
        }else if($this->method() == "PATCH") {
            $user = $this->route("user");
            if($user->name != $this->name)
                $data['username'] = Slug::createSlug(User::class, ".", $this->name, "username");
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
