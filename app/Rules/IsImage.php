<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsImage implements Rule
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
        $imageInfo = explode(";base64,", $value);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        return $imgExt == 'jpeg';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Картинка повинна бути в форматі jpeg';
    }
}
