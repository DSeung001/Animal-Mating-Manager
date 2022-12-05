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
            "type_id" => "required",
            "mating_id" => "required",
            "spawn_at" => "required"
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종을 선택해주세요.",
            "mating_id.required" => "메이팅을 선택해주세요.",
            "spawn_at.required" => "산란일을 선택해주세요."
        ];
    }
}
