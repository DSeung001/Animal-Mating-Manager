<?php

namespace App\Http\Requests;

class EggRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "mating_id" => "required",
        ];
    }

    public function messages()
    {
        return [
            "mating_id.required" => "메이팅을 선택해주세요.",
        ];
    }
}
