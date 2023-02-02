<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LargeCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            "type_id" => "required",
            "name" => "required|array|max:100",
            "morph" => "required|array|max:100",
            "name.*" => "required|max:128",
            "morph.*" => "required|max:128",
        ];
    }

    public function messages()
    {
        return [
            "type_id.required" => "종을 선택하십시오.",

            "name.max" => "개체 이름 입력 값은 최대 100입니다.",
            "name.*.required" => "개체 이름을 입력하십시오.",
            "name.*.max" => "개체 이름은 최대 128자까지 입력 가능합니다.",

            "morph.max" => "개체 모프 입력 값은 최대 100입니다.",
            "morph.*.required" => "개체 모프를 입력하십시오.",
            "morph.*.max" => "개체 모프는 최대 128자까지 입력 가능합니다.",
        ];
    }
}
