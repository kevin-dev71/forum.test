<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidReply implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strlen($value) > 10 && strlen($value) < 500;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("La :attribute debe tener entre 10 y 500 caracteres");
    }
}
