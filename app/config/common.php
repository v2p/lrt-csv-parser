<?php

return [
    'entityManager.db' => [
        'host'     => 'mysql-service', // in case of Docker
        'driver'   => 'pdo_mysql',
        'user'     => 'user',
        'password' => 'password',
        'dbname'   => 'database',
    ],
    'entityManager.pathToEntityFiles' => __DIR__ . '/../src/Lrt/Entities'
];
