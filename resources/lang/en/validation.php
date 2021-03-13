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

    'accepted' => ':attribute повинен бути визначеним.',
    'active_url' => ':attribute невалідний URL.',
    'after' => ':attribute має бути дата після :date.',
    'after_or_equal' => ':attribute має бути дата рівною або після :date.',
    'alpha' => ':attribute може містити лише літери.',
    'alpha_dash' => ':attribute може містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => ':attribute може містити лише літери та цифри.',
    'array' => ':attribute повинен бути масивом.',
    'before' => ':attribute повинно бути перед датою :date.',
    'before_or_equal' => ':attribute має бути дата рівною або після :date.',
    'between' => [
        'numeric' => ':attribute має бути в діапазоні між :min та :max.',
        'file' => ':attribute має бути в діапазоні між :min та :max кілобайт.',
        'string' => ':attribute має бути в діапазоні між :min та :max символів.',
        'array' => ':attribute має бути в діапазоні між :min та :max елементів.',
    ],
    'boolean' => ':attribute повинен бути логічного типу.',
    'confirmed' => ':attribute підтвердження не пройшло.',
    'date' => ':attribute Невірно вказана дата.',
    'date_equals' => ':attribute повинно відповідати даті :date.',
    'date_format' => ':attribute не відповідає формату :format.',
    'different' => ':attribute та :other повинні бути різними.',
    'digits' => ':attribute повинен бути :digits цифрами.',
    'digits_between' => ':attribute має бути в діапазоні між :min та :max цифр.',
    'dimensions' => ':attribute має невірні розміри зображення.',
    'distinct' => ':attribute поле має повторюване значення.',
    'email' => ':attribute не вірно вказаний формат електронної адреси.',
    'ends_with' => ':attribute має закінчуватися одним із наступних значень: :values.',
    'exists' => 'Вибраний :attribute невірний.',
    'file' => ':attribute повинен бути файлом.',
    'filled' => ':attribute поле повинно мати значення.',
    'gt' => [
        'numeric' => ':attribute повинен бути більшим за :value.',
        'file' => ':attribute має бути більшим ніж :value кілобайт.',
        'string' => ':attribute має бути більшим ніж :value символів.',
        'array' => ':attribute повинен містити більше :value елементів.',
    ],
    'gte' => [
        'numeric' => ':attribute повинен бути більшим або рівним :value.',
        'file' => ':attribute повинен бути більшим або рівним :value кілобайт.',
        'string' => ':attribute повинен бути більшим або рівним :value символів.',
        'array' => ':attribute має містити :value елементів або більше.',
    ],
    'image' => ':attribute повинен бути зображенням.',
    'in' => 'Вибраний :attribute невірний.',
    'in_array' => ':attribute не існує в :other.',
    'integer' => ':attribute повинен бути цілочисельним.',
    'ip' => ':attribute повинен бути валідною IP-адресою.',
    'ipv4' => ':attribute повинен бути валідною IPv4 адресою.',
    'ipv6' => ':attribute повинен бути валідною IPv6 адресою.',
    'json' => ':attribute  повинен бути валідним JSON рядком.',
    'lt' => [
        'numeric' => ':attribute має бути меншим ніж :value.',
        'file' => ':attribute має бути меншим ніж :value кілобайт.',
        'string' => ':attribute має бути меншим ніж :value символів.',
        'array' => ':attribute має містити менше ніж :value елеентів.',
    ],
    'lte' => [
        'numeric' => ':attribute повинен бути більшим або рівним :value.',
        'file' => ':attribute повинен бути більшим або рівним :value кілобайт.',
        'string' => ':attribute повинен бути більшим або рівним :value символів.',
        'array' => ':attribute не повинен мати більше :value елементів.',
    ],
    'max' => [
        'numeric' => ':attribute може бути не більше ніж :max.',
        'file' => ':attribute може бути не більше ніж :max кілобайт.',
        'string' => ':attribute може бути не більше ніж :max символів.',
        'array' => ':attribute не може мати більше ніж :max елементів.',
    ],
    'mimes' => ':attribute повинен бути файл типу: :values.',
    'mimetypes' => ':attribute повинен бути файл типу: :values.',
    'min' => [
        'numeric' => ':attribute має бути більшим ніж :min.',
        'file' => ':attribute має бути більшим ніж :min кілобайт.',
        'string' => ':attribute має бути більшим ніж :min символів.',
        'array' => ':attribute має містити більше ніж :min елементів.',
    ],
    'multiple_of' => ':attribute має бути кратним :value',
    'not_in' => 'Вибраний :attribute невірний.',
    'not_regex' => ':attribute має невірний формат.',
    'numeric' => ':attribute повинен бути числом.',
    'password' => 'Невірний пароль.',
    'present' => ':attribute поле повинно бути заповненим.',
    'regex' => ':attribute має невірний формат.',
    'required' => ':attribute обов’язкове значення.',
    'required_if' => ':attribute обов’язкове значення при :other = :value.',
    'required_unless' => ':attribute поле є обов\'язковим, якщо :other недорівнює :values.',
    'required_with' => ':attribute поле обов’язкове, якщо значення :values вказане.',
    'required_with_all' => ':attribute поле обов\'язкове коли значення :values вказані.',
    'required_without' => ':attribute fполе обов\'язкове коли значення :values не вказані.',
    'required_without_all' => ':attribute поле є обов\'язковим, якщо кожне з значень :values вказане.',
    'same' => ':attribute та :other повинні співпадати.',
    'size' => [
        'numeric' => ':attribute повинно мати роозмір :size.',
        'file' => ':attribute повинно мати роозмір :size кілобайт.',
        'string' => ':attribute повинно мати :size символів.',
        'array' => ':attribute повинно включати :size елементи.',
    ],
    'starts_with' => ':attribute повинно починатися з одного з наступних елеметів: :values.',
    'string' => ':attribute повинен бути рядком.',
    'timezone' => ':attribute повинно бути у вірній часовій зоні.',
    'unique' => ':attribute вже зареєстрований.',
    'uploaded' => ':attribute не вдалося завантажити.',
    'url' => ':attribute неірно вказаний формат.',
    'uuid' => ':attribute поинен бути валідним UUID.',

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

    'attributes' => [],

];
