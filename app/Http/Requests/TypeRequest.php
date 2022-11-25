<?php

namespace App\Http\Requests;

class TypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|max:128",
            "hatch_day" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "종류 명칭을 입력해주세요.",
            "name.max" => "128자 이내로 입력해주세요.",
            "hatch_day" => "해칭 소요 기간을 입력해주세요",
        ];
    }
}
