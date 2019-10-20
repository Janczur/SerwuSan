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
    'accepted' => ':attribute musi zostać zaakceptowane.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi zawierać datę, która jest po :date.',
    'alpha' => ':attribute może zawierać jedynie litery.',
    'alpha_dash' => ':attribute może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num' => ':attribute może zawierać jedynie litery i cyfry.',
    'array' => ':attribute musi zawierać jakieś elementy.',
    'before' => ':attribute musi zawierać datę, która jest przed :date.',
    'between' => [
        'numeric' => ':attribute musi mieścić się w granicach :min - :max.',
        'file' => ':attribute musi mieć :min - :max kilobajtów.',
        'string' => ':attribute musi mieć :min - :max znaków.',
        'array' => ':attribute musi być pomiędzy :min, a :max.',
    ],
    'boolean' => ':attribute możę być tylko true lub false.',
    'confirmed' => 'Potwierdzenie :attribute się nie zgadza.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_format' => ':attribute nie jest datą w formacie: :format.',
    'different' => ':attribute i :other muszą się od siebie różnić.',
    'digits' => ':attribute musi być :digits numerem.',
    'digits_between' => ':attribute musi być pomiędzy numerami :min i :max.',
    'email' => ':attribute nie jest adresem email.',
    'filled' => 'Pole :attribute jest wymagane.',
    'exists' => ':attribute nie istnieje.',
    'image' => ':attribute musi być obrazkiem.',
    'in' => 'Zaznaczona opcja :attribute jest nieprawidłowa.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być prawidłowym adresem IP.',
    'max' => [
        'numeric' => ':attribute musi być poniżej :max.',
        'file' => ':attribute musi mieć poniżej :max kilobajtów.',
        'string' => ':attribute musi mieć poniżej :max znaków.',
        'array' => ':attribute nie może zawierać więcej niż :max elementów.',
    ],
    'mimes' => ':attribute musi być plikiem rodzaju :values.',
    'min' => [
        'numeric' => ':attribute musi być co najmniej :min.',
        'file' => 'Plik :attribute musi mieć co najmniej :min kilobajtów.',
        'string' => ':attribute musi mieć co najmniej :min znaków.',
        'array' => ':attribute musi mieć conajmniej :min elementów.',
    ],
    'not_in' => 'Zaznaczona opcja :attribute jest nieprawidłowa.',
    'numeric' => ':attribute musi być numeryczne.',
    'regex' => 'Pole :attribute jest nieprawidłowego formatu.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'Pole :attribute jest wymagane jeśli pole :other ma wartość :value.',
    'required_with' => 'Pole :attribute jest wymagane wraz z polem :values.',
    'required_with_all' => 'Pole :attribute jest wymagane wraz z polem :values.',
    'required_without' => 'Pole :attribute jest wymagane jeśli nie ma pola :values.',
    'required_without_all' => 'Pole :attribute jest wymagane jeśli żadna z wartości (:values) nie jest podana.',
    'same' => ':attribute i :other muszą być takie same.',
    'size' => [
        'numeric' => ':attribute musi mieć rozmiary :size.',
        'file' => ':attribute musi mieć :size kilobajtów.',
        'string' => ':attribute musi mieć :size znaków.',
        'array' => ':attribute musi zawierać :size elementów.',
    ],
    'string' => ':attribute musi być tekstem.',
    'unique' => ':attribute zostało już użyte.',
    'url' => ':attribute - to nieprawidłowy adres URL.',
    'timezone' => ':attribute jest nieprawidłową strefą czasową.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [],
];
