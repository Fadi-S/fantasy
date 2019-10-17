<?php

namespace App\Http\Requests;

use App\Http\Helpers\Slug;
use App\Models\Group\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
                "slug" => "required|unique:groups",
            ];
        }else {
            return [
                "name" => "required",
                "slug" => [
                    Rule::unique('groups')->ignore($this->route("group")->slug),
                ],
            ];
        }
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        if($this->method() == "POST") {

            $data['slug'] = Slug::createSlug(Group::class, "-", Slug::make_slug($this->name), "slug");

        }else if($this->method() == "PATCH") {

            if($this->route("group")->name != $this->name)
                $data['slug'] = Slug::createSlug(Group::class, "-", Slug::make_slug($this->name), "slug");

        }

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
