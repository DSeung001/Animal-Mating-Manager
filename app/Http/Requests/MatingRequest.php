<?php

namespace App\Http\Requests;

class MatingRequest extends FormRequest
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
            "father_id" => "required",
            "mather_id" => "required",
            "mating_at" => "required|date",
            "comment" => "max:512",
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종류를 선택하십시오.",
            "father_id.required" => "부 개체를 선택하십시오.",
            "mather_id.required" => "모 개체를 선택하십시오.",
            "mating_at.required" => "메이팅일을 선택하십시오.",
            "mating_at.date" => "메이팅일이 유효 타입이 아닙니다.",
            "comment.max" => "설명은 최대 512자입니다."
        ];
    }
}
