<?php

return array(
    "accepted"             => ":attribute musi zostać zaakceptowane.", //yes, 1, true
    "active_url"           => ":attribute nie jest prawidłowym adresem URL.",
    "after"                => ":attribute musi być datą późniejszą niż :date.",
    "alpha"                => ":attribute może zawierać tylko litery.",
    "alpha_dash"           => ":attribute może zawierać tylko litery, cyfry i podkreślenia.",
    "alpha_num"            => ":attribute może zawierać tylko litery i cyfry.",
    "array"                => ":attribute musi być tablicą.",
    "before"               => ":attribute musi być datą wcześniejszą niż :date.",
    "between"              => array(
        "numeric" => ":attribute musi być wartością pomiędzy :min i :max.",
        "file"    => ":attribute musi mieć pomiędzy :min a :max kilobajtów.",
        "string"  => ":attribute musi mieć pomiędzy :min a :max znaków.",
        "array"   => ":attribute musi mieć pomiędzy :min a :max pozycji.",
    ),
    "boolean"              => "Pole musi być true lub false",
    "confirmed"            => "Pola nie są takie same.",
    "date"                 => ":attribute nie jest prawidłową datą.",
    "date_format"          => ":attribute nie zgadza się z formatem :format.",
    "different"            => ":attribute i :other muszą być różne.",
    "digits"               => ":attribute musi mieć :digits cyfr.",
    "digits_between"       => ":attribute musi mieć pomiędzy :min a :max cyfr.",
    "email"                => ":attribute must be a valid email address.",
    "exists"               => "wybrany :attribute jest nieprawidłowy.",
    "image"                => "Pole musi być obrazkiem.",
    "in"                   => "wybrany :attribute jest nieprawidłowy.",
    "integer"              => "Pole musi być liczbą.",
    "ip"                   => ":attribute musi być poprawnym adresem IP.",
    "max"                  => array(
        "numeric" => ":attribute nie może być większy niż :max.",
        "file"    => ":attribute nie może być większy niż :max kilobajtów.",
        "string"  => ":attribute nie może być dłuższy niż :max znaków.",
        "array"   => ":attribute nie może mieć więcej niż :max pozycji.",
    ),
    "mimes"                => ":attribute musi być plikiem typu: :values.",
    "min"                  => array(
        "numeric" => "Pole musi być większy lub równy :min.",
        "file"    => "Pole musi mieć co najmniej :min kilobajtów.",
        "string"  => "Pole musi mieć co najmniej :min znaków.",
        "array"   => "Pole musi mieć co najmniej :min pozycji.",
    ),
    "not_in"               => "wybrany :attribute jest nieprawidłowy.",
    "numeric"              => ":attribute must be a number.",
    "regex"                => "format :attribute jest nieprawidłowy",
    "required"             => "Pole jest wymagane.",
    "required_if"          => "Pole :attribute jest wymagane, gdy :other ma wartość :value.",
    "required_with"        => "Pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_with_all"    => "Pole :attribute jest wymagane, gdy :values są zdefiniowane.",
    "required_without"     => "Pole :attribute jest wymagane, gdy :values nie są zdefiniowane.",
    "required_without_all" => "Pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.",
    "same"                 => ":attribute i :other muszą być takie same.",
    "size"                 => array(
        "numeric" => ":attribute must be :size.",
        "file"    => ":attribute musi mieć :size kilobajtów.",
        "string"  => ":attribute musi mieć :size znaków.",
        "array"   => ":attribute musi zawierać :size pozycji.",
    ),
    "unique"               => "Taka wartość jest już niedostępna.",
    "url"                  => "Format wartości jest nieprawidłowy.",
    "timezone"             => ":attribute musi być prawidłową strefą czasową.",
    "before_or_equal"      => "Niepoprawnie wprowadzone daty.",
    "after_or_equal"      => "Niepoprawnie wprowadzone daty.",
    "dimensions" => "Niepoprawne wymiary zdjęcia, minimalnie - :min_width x :min_height px i maksymalnie - :max_width x :max_height px.",

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

    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        'username' => 'nazwa użytkownika'
    ),

);
