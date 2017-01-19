<?php

return [

    'driver' => 'smtp',
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', '587'),
    'from' => ['address' => 'lk@azs-smart.ru', 'name' => 'AskOnlineeeee'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME', 'username@gmail.com'),
    'password' => env('MAIL_PASSWORD', 'password'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,


//    'to' => 'petkevich.igor@gmail.com',
    'to' => 'info@azs-smart.ru',
];

