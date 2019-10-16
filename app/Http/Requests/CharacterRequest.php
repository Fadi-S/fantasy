<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
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
        if($this->method() == "POST") {
            return [
                "name" => "required",
                "picture" => "required",
                "category_id" => "required|numeric|notIn:0",
            ];
        }else {
            return [
                "name" => "required",
                "category_id" => "required|numeric|notIn:0",
            ];
        }
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        if($this->hasFile("image")) {
            $file = $this->file("image");

            $image = str_random(60) . '.' . $file->extension();

            if($file->storeAs('public/photos/characters', $image))
                $data["picture"] = $image;
        }

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
