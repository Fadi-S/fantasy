<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($this->method() == "POST")
            return [
                "name" => "required",
                "max_minutes" => "required|numeric|notIn:0",
                "start_date" => "required",
                "end_date" => "required",
            ];
        else
            return [
                "name" => "required",
                "max_minutes" => "required|numeric|notIn:0",
                "start_date" => "required",
                "end_date" => "required",
            ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['start_date'] = Carbon::createFromFormat("d/m/Y h:i A", explode(" - ", $data['dateRange'])[0]);
        $data['end_date'] = Carbon::createFromFormat("d/m/Y h:i A", explode(" - ", $data['dateRange'])[1]);

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
