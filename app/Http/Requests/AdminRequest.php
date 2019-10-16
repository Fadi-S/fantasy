<?php

namespace App\Http\Requests;

use App\Http\Helpers\Slug;
use App\Models\Admin\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
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
                'username' => Rule::unique('admins')->ignore($this->route("admin")->id),
                'email' => [
                    "required",
                    "email",
                    Rule::unique('admins')->ignore($this->route("admin")->id)
                ]
            ];
        }else {
            $rules = [
                'name' => "required",
                'username' => "required|unique:admins",
                'email' => "required|email|unique:admins",
                'password' => "required|min:6"
            ];
        }

        return $rules;
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        if($this->method() == "POST") {
            $data['username'] = Slug::createSlug(Admin::class, ".", $this->name, "username");
        }else if($this->method() == "PATCH") {
            $user = $this->route("admin");
            if($user->name != $this->name)
                $data['username'] = Slug::createSlug(Admin::class, ".", $this->name, "username");
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
