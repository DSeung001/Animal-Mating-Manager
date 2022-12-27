<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $rules = [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ];

        $messages =  [
            'current_password.string' => '현재 비밀번호 형식이 올바르지 않습니다',
            'current_password.required' => '현재 비밀번호를 입력해주세요',
            'current_password.current_password' => __('현재 비밀번호와 일치하지 않습니다.'),
            'password.required' => '비밀번호를 입력하십시오.',
            'password.string' => '비밀번호의 형식이 옳지 않습니다.',
            'password.max' => '비밀번호는 최대 64자입니다.',
            'password.min' => '비밀번호는 최소 8자입니다.',
            'password.confirmed' => '확인 비밀번호가 다릅니다.'
        ];

        Validator::make($input, $rules, $messages)->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
