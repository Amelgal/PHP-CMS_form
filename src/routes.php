<?php

return [
    '~^hello~' => [\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\Controllers\MainController::class, 'main'],
    '~^users/register$~' => [\Controllers\UsersController::class, 'signUp'],
];