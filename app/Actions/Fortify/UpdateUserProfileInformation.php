<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $rules = [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        $messages = [
            'name.required' => '이름을 입력하십시오',
            'name.string' => '이름의 형식이 옳지 않습니다.',
            'name.max' => '최대 영문은 64자, 한글은 32자입니다.',
            'email.required' => '이메일을 입력하십시오.',
            'email.email' => '이메일의 형식이 옳지 않습니다.',
            'email.unique' => '이메일이 중복됩니다.',
            'email.max' => '이메일은 최대 255자입니다.',
            'photo.mimes' => '제공하는 이미지 확장자는 jpg,jpeg,png 입니다.',
            'photo.max' => '이미지 사이즈는 최대 1MB 입니다.'
        ];

        Validator::make($input, $rules, $messages)->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
