<?php

namespace App\Http\Requests;

use App\Http\Helpers\Slug;
use App\Models\Competition\Competition;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompetitionRequest extends FormRequest
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
                "slug" => "required|unique:competitions",
                "start" => "required",
                "end" => "required",
                "group_id" => "required|numeric|notIn:0",
                "type_id" => "required|numeric|notIn:0",
                "late_penalty" => "numeric|min:0|max:1",
            ];
        }else {
            return [
                "name" => "required",
                "start" => "required",
                "end" => "required",
                "group_id" => "required|numeric|notIn:0",
                "slug" => [
                    Rule::unique('competitions')->ignore($this->route("competition")->slug),
                ],
                "late_penalty" => "numeric|min:0|max:1",
            ];
        }
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data['start'] = Carbon::createFromFormat("d/m/Y", explode(" - ", $data['dateRange'])[0]);
        $data['end'] = Carbon::createFromFormat("d/m/Y", explode(" - ", $data['dateRange'])[1]);

        if($this->method() == "POST") {

            $data['slug'] = Slug::createSlug(Competition::class, "-", Slug::make_slug($this->name), "slug");

        }else if($this->method() == "PATCH") {

            $competition = $this->route("competition");
            if($competition->name != $this->name)
                $data['slug'] = Slug::createSlug(Competition::class, "-", Slug::make_slug($this->name), "slug");

        }

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
