<?php
return [
    "acl" => [
        'home' => [
            'index' => ['all'],
            'postlist' => ['all']
        ],
        'user' => [
            'login' => ['all'],
            'registration' => ['all'],
            'logout' => ['user', 'admin'],
            'paypal' => ['all'],
            'restore' => ['all'],
        ],
        'error' => [
            'index' => ['all'],
            'error404' => ['all'],
            'error403' => ['all'],
        ],
    ],
];