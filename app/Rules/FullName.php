<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FullName implements Rule
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
        // проходит проверку, если есть 3 слова разделёнными пробелами. Слова должны состоять
        // минимум из 2-х символов. Могут содержать знаки(не первым символом).
        return preg_match(
            '/^(?:[A-Za-zА-Яа-яёЁъЪ][-,A-Za-zА-Яа-яёЁъЪ.\']+ ){2}[A-Za-zА-Яа-яёЁъЪ][-,A-Za-zА-Яа-яёЁъЪ.\']+$/u',
            $value
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.full_name');
    }
}
