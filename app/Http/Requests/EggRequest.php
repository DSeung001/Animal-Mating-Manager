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
            "spawn_at" => "required",
            "comment" => "max:512",
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종을 선택하십시오.",
            "mating_id.required" => "메이팅을 선택하십시오.",
            "spawn_at.required" => "산란일을 선택하십시오.",
            "comment.max" => "설명은 최대 512자입니다."
        ];
    }
}
