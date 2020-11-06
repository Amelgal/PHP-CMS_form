<?php
return [
    'full_name' => [
        'first_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный First name',
            'name'=>'First name'
            ],
        'middle_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Middle name',
            'name'=>'Middle name'

        ],
        'last_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Last name',
            'name'=>'Last name'

        ],
    ],
    'nickname' => [
        'first_n' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Nickname',
            'name'=>'Nickname'

        ],
    ],
    'password' => [
        'first_n' => [
            'regexp' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Password',
            'name'=>'Password'

        ],
    ],
    'email' => [
        'email' => [
            'regexp' => '~^.*$~',
            'error'=>'Недоступный Email',
            'filter' => FILTER_VALIDATE_EMAIL,
            'name'=>'Email'

        ],

    ],
    'birth_data' => [
        'day' => [
            'regexp' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Day',
            'name'=>'Day'

        ],
        'month' => [
            'regexp' => '~^[a-яA-Я]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Month',
            'name'=>'Month'
        ],
        'year' => [
            'regexp' => '~^[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Year',
            'name'=>'Year'

        ],
    ],
    'gender' => [
        'gender' => [
            'regexp' => '~^(Male|Female)$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Gender',
            'name'=>'Gender'
        ],
    ],
    'full_address' => [
        'city' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный City',
            'name'=>'City'
        ],
        'street_address' => [
            'regexp' => '~^[a-яA-Я .,[0-9]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Street address',
            'name'=>'Street adress'

        ],
        'country' => [
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Country',
            'name'=>'Country'
        ],
    ],
    'course' => [
        '0' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Course',
            'name'=>'Course'

        ],
        '1' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Course',
            'name'=>'Course'

        ],
        '2' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Course',
            'name'=>'Course'

        ],
        '3' =>[
            'regexp' => '~^[Windows (Xp|0-9)]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Course',
            'name'=>'Course'

        ],
    ],
    'textarea' => [
        'textarea' =>[
            'regexp' => '~^[a-яA-Я ]*$~',
            'filter' => FILTER_VALIDATE_REGEXP,
            'error'=>'Недоступный Textarea',
            'name'=>'Textarea'

        ],
    ],
];