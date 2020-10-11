<?php

//For to connect to database : https://laravel.com/docs/8.x/database#configuration

return [
    'default' => 'sqlite',
    'connections' => [
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => database_path('database.sqlite'),
        ],
    ]
];