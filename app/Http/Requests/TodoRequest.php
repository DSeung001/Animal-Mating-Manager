<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            "cycle" => "required|integer",
            "started_at" => "required",
            "comment" => "max:512"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "종 명칭을 입력하십시오.",
            "name.max" => "128자 이내로 입력하십시오.",
            "cycle.required" => "주기를 입력해주세요.",
            "cycle.integer" => "주기 형식이 숫자가 아닙니다.",
            "started_at" => "시작일을 입력하십시오.",
            "comment.max" => "설명은 최대 512자입니다."
        ];
    }
}
