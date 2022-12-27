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
            "reptile_image" => "nullable|max:5120|mimes:jpg,png,jpeg,gif,svg"
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종을 선택하십시오.",
            "name.required" => "개체 이름을 입력하십시오.",
            "name.max" => "개체 이름은 최대 128자까지 입력 가능합니다.",
            "gender.required" => "개체 성별를 선택하십시오.",
            "gender.required_with" => "유효하지 않은 성별 입력입니다.",
            "status.required" => "개체의 현재 상태를 선택하십시오.",
            "status.required_with" => "유효하지 않은 상태re 입력입니다.",
            "morph.required" => "개체 모프를 입력하십시오.",
            "morph.max" => "개체 모프는 최대 128자까지 입력 가능합니다.",
            "reptile_image.max" => "이미지 사이즈는 최대 5MB 입니다.",
            "reptile_image.mimes" => "허용하지 않는 이미지 확장자입니다."
        ];
    }
}
