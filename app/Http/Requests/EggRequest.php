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
            "spawn_at" => "required"
        ];
    }

    public function messages()
    {
        return [
            "spawn_at.required" => "산란일을 선택해주세요"
        ];
    }
}
