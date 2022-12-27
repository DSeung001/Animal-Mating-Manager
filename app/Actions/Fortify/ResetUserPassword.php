<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        $rules = [
            'password' => $this->passwordRules(),
        ];

        $messages = [
            'password.required' => '비밀번호를 입력하십시오.',
            'password.string' => '비밀번호의 형식이 옳지 않습니다.',
            'password.max' => '비밀번호는 최대 64자입니다.',
            'password.min' => '비밀번호는 최소 8자입니다.',
            'password.confirmed' => '확인 비밀번호가 다릅니다.'
        ];

        Validator::make($input, $rules, $messages)->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
