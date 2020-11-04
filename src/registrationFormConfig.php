<?php
return [
    'full_name' => [
        'first_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'first_n',
            ],
        'middle_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'middle_n',
        ],
        'last_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'last_n',
        ],
    ],
    'email' => [
        'email' => [
            'regexp' => '~^.*$~',
            'error'=>'email',
            'filter' => FILTER_VALIDATE_EMAIL,
        ],

    ],
    'birth_data' => [
        'day' => [
            'regexp' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'day',
        ],
        'month' => [
            'regexp' => '~^[a-яA-Я]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'month',
        ],
        'year' => [
            'regexp' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'year',
        ],
    ],
    'gender' => [
        'gender' => [
            'regexp' => '~^(Male|Female)$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'gender',
        ],
    ],
    'full_address' => [
        'city' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'city',
        ],
        'street_address' => [
            'regexp' => '~^[a-яA-Я .,[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'street_address',
        ],
        'country' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'country',
        ],
    ],
    'course' => [
        '0' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'course',
        ],
        '1' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'course',
        ],
        '2' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'course',
        ],
        '3' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'course',
        ],
    ],
    'textarea' => [
        'textarea' =>[
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'textarea',
        ],
    ],
];