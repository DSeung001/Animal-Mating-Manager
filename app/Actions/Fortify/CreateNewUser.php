<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $rules = [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        $messages = [
            'name:required' => '이름을 입력하십시오.',
            'name.string' => '이름의 형식이 옳지 않습니다.',
            'name.max' => '최대 영문은 64자, 한글은 32자입니다.',
            'email.required' => '이메일을 입력하십시오.',
            'email.string' => '이메일의 형식이 옳지 않습니다.',
            'email.email' => '이메일의 형식이 옳지 않습니다.',
            'email.max' => '이메일은 최대 255자입니다.',
            'email.unique' => '이메일이 중복됩니다.',
            'password.required' => '비밀번호를 입력하십시오.',
            'password.string' => '비밀번호의 형식이 옳지 않습니다.',
            'password.max' => '비밀번호는 최대 64자입니다.',
            'password.min' => '비밀번호는 최소 8자입니다.',
            'password.confirmed' => '확인 비밀번호가 다릅니다.'
        ];

        Validator::make($input, $rules, $messages)->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
