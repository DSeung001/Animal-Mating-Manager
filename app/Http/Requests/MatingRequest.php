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
            "father_id" => "required",
            "mather_id" => "required",
            "mating_at" => "required|date",
        ];
    }

    public function messages()
    {
        return [
            "father_id.required" => "부 개체를 선택해주세요.",
            "mather_id.required" => "모 개체를 선택해주세요.",
            "mating_at.required" => "메이팅일을 선택해주세요.",
            "mating_at.date" => "메이팅일이 유효 타입이 아닙니다.",
        ];
    }
}
