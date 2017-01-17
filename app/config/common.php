<?php

return [
    'entityManager.db' => [
        'host'     => getenv('MYSQL_HOST'),
        'driver'   => 'pdo_mysql',
        'user'     => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_PASSWORD'),
        'dbname'   => getenv('MYSQL_DATABASE'),
        'charset'  => 'utf8',
    ],
    'entityManager.pathToEntityFiles' => __DIR__ . '/../src/Lrt/Entity',
    'templateEngine.pathToTemplates' => __DIR__ . '/../views'
];
