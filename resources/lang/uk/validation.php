<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'Поле :attribute повинна бути після :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => ' :attribute повинна бути маншою за :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'Поле :attribute не співпадає.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Поле :attribute має бути email адресою.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ':attribute повинно бути зображенням.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => ':attribute не повинно перевищувати :max kilobytes.',
        'string' => 'Поле :attribute перевищує максимальне значення :max символів.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Поле :attribute повинно бути не менше :min символів.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'Невірний формат :attribute.',
    'numeric' => 'Поле :attribute повинно бути цифрою.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'Невірний формат поля :attribute.',
    'required' => 'Поле :attribute є обов\'язковим.',
    'is_metatrue' => 'Це поле повинно бути через кому (слово1, слово2, слово3, ...).',
    'is_png' => 'Повинно бути зображенням формату png.',
    'required_if' => 'Це поле є обов\'язковим :attribute коли :other є :value.',
    'required_unless' => 'Це поле є обов\'язковим :attribute якщо :other є в :values.',
    'required_with' => 'Це поле є обов\'язковим :attribute коли :values являється вірним.',
    'required_with_all' => 'Це поле є обов\'язковим :attribute коли :values вірне.',
    'required_without' => 'Це поле є обов\'язковим :attribute коли :values не є вірним.',
    'required_without_all' => 'Це поле є обов\'язковим :attribute коли не один із :values не є вірним.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'Поле :attribute повинно бути :size симовлів.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => ':attribute поле повинно бути рядком.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Поле :attribute унікальне в межах сервісу, використайте інше значення.',
    'uploaded' => 'помилка завантаження :attribute.',
    'url' => 'Поле :attribute не є коректною адресою.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'Ім\'я',
        'email' => 'Email',
        'password' => 'пароль',
        'address' => 'адреса',
        'telephone' => 'телефон',
        'description' => 'опис',
        'slug' => 'посилання',
        'text'=> 'текст',
        'photo' => 'завантаження зображення',
        'link' => 'посилання',
        'cover' => 'зображення',
        'first_title' => 'Заголовок',
        'img' => 'зображення',
        'search' => 'пошуку',
        'preview' => 'зображення',
        'title' => 'заголовок',
        'meta_description' => 'короткого опису',
        'meta_keywords' => 'пошуку по-ключовим словам',
        'searchOf' => 'початкова дата',
        'searchBy' => 'кінцева дата',
    ],

];
