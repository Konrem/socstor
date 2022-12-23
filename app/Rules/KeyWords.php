<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KeyWords implements Rule
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
        $regexp = "/^(([-а-яіїґёА-ЯІЇҐЁ]|[a-zA-Z]|[0-9])+(\,\ ))*([-а-яіїґёА-ЯІЇҐЁ]|[a-zA-Z]|[0-9])+$/ui";
        
        return preg_match($regexp, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ключові слова перечислити через кому (слово1, слово2, слово3, ...).';
    }
}
