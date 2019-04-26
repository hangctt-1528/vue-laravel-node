<?php

return [
    'api' => [
        'token_expire_in' => 60,
        'reset_password' => [
            'token_length' => 10,
            'expire' => 60,
        ],
        'personal_access_token' => [
            'name' => 'Personal Access Token',
            'token_type' => 'Bearer',
        ],
    ],
];
