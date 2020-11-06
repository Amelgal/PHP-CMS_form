<?php
// паттерны для роутинга
return [
    '~^$~' => [\Controllers\MainController::class, 'ActionMainPage'],
    '~^users/register$~' => [\Controllers\UsersController::class, 'ActionSignUp'],
    '~^test/script$~' => [\Controllers\CronController::class, 'ActionSendMail'],
    '~^users/login~' => [\Controllers\UsersController::class, 'ActionLogin'],
    '~^users/logout~' => [\Controllers\UsersController::class, 'ActionLogout'],
];