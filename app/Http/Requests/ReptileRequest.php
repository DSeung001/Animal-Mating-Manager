<?php

namespace App\Http\Requests;

class ReptileRequest extends FormRequest
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
            "name" => "required|max:128",
            "gender" => "required|required_with:m,f,u",
            'status' => "required|required_with:g,i,o,s,d",
            "morph" => "required|max:128",
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종을 선택해주세요.",
            "name.required" => "개체 이름을 입력해주세요.",
            "name.max" => "개체 이름은 최대 128자까지 입력 가능합니다.",
            "gender.required" => "개체 성별를 선택해주세요.",
            "gender.required_with" => "유효하지 않은 성별 입력입니다.",
            "status.required" => "개체의 현재 상태를 선택해주세요.",
            "status.required_with" => "유효하지 않은 상태re 입력입니다.",
            "morph.required" => "개체 모프를 입력해주세요.",
            "morph.max" => "개체 모프는 최대 128자까지 입력 가능합니다.",
        ];
    }
}
