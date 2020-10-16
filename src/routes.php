<?php
// паттерны для роутинга
return [
    '~^$~' => [\Controllers\MainController::class, 'main'],
    '~^users/register$~' => [\Controllers\UsersController::class, 'signUp'],
    '~^test/script$~' => [\Controllers\MailSenderController::class, 'sendMail'],
];