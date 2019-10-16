<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TextRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($this->method() == "POST")
            return [
                "character_id" => "required|notIn:0|numeric",
                "quiz_id" => "required|notIn:0|numeric",
                "name" => "required",
            ];
        else
            return [
                "name" => "required",
            ];
    }
}
