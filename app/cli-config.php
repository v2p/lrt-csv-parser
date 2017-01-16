<?php

// This file is necessary to run doctrine CLI

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Lrt\DependencyInjection\ContainerFactory;
use Lrt\DependencyInjection\DataStorageServiceProvider;

require_once __DIR__ . '/vendor/autoload.php';

$configuration = require_once __DIR__ . '/config/cli.php';

$container = (new ContainerFactory())
    ->create($configuration);

return ConsoleRunner::createHelperSet(
    $container[DataStorageServiceProvider::SERVICE_ENTITY_MANAGER]
);