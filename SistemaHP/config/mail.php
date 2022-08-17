<?php
return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 465),
    'from' => ['address' => 'testaplicacionessmtp@gmail.com', 'name' => 'testaplicacionessmtp'],
    'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
    'username' => env('MAIL_USERNAME','testaplicacionessmtp@gmail.com'),
    'password' => env('MAIL_PASSWORD','kxpyepacbrkzvplu'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'stream' => [
        'ssl' => [
            'allow_self_signed' => true,
            'verify_peer'       => false,
            'verify_peer_name'  => false,
        ],
    ],
];

