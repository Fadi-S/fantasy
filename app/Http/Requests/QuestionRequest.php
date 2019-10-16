<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
        if($this->method() == "POST")
            return [
                "character_id" => "required|notIn:0|numeric",
                "quiz_id" => "required|notIn:0|numeric",
                "body" => "required",
                "right" => "required",
            ];
        else
            return [
                "body" => "required",
                "right" => "required",
            ];
    }
}
