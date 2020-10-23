<?php
return [
    'full_name' => [
        'first_n' => [
            'expression' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            ],
        'middle_n' => [
            'expression' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
        'last_n' => [
            'expression' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
    ],
    'email' => [
        'expression' => '~^.*$~',
        'filter' => FILTER_VALIDATE_EMAIL,
    ],
    'birth_data' => [
        'day' => [
            'expression' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
        'month' => [
            'expression' => '~^[a-яA-Я]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
        'year' => [
            'expression' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
    ],
    'gender' => [
        'expression' => "!preg_match('~^(Male|Female)$~')",
        'filter' => FILTER_VALIDATE_REGEXP,
    ],
    'full_address' => [
        'city' => [
            'expression' => "!preg_match('~^[a-яA-Я ]*$~')",
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
        'street_address' => [
            'expression' => "!preg_match('~^[a-яA-Я .,[0-9]*$~')",
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
        'country' => [
            'expression' => "!preg_match('~^[a-яA-Я ]*$~')",
            'filter' => FILTER_VALIDATE_REGEXP,
        ],
    ],
    'course' => [
            'expression' => "!preg_match('~^[Windows (Xp|0-9)]*$~')",
            'filter' => FILTER_VALIDATE_REGEXP,
    ],
    'textarea' => [
        'expression' => "!preg_match('~^[a-яA-Я ]*$~')",
        'filter' => FILTER_VALIDATE_REGEXP,
    ],
];