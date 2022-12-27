<?php

namespace App\Actions\Fortify;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
//        return ['required', 'string', new Password, 'confirmed'];
        return ['required', 'string','confirmed', 'max:64', 'min:8'];
    }
}
