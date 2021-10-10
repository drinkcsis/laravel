<?php

return [
    'type' => 'bearer', //posible values 'jwt' or 'bearer'
    'jwt' => [
        'secret' => env('JWT_SECRET', 'some secret string')
    ],
    'allow_users' => [
        'user1' => '111',
        'user2' => '222'
    ]
];
