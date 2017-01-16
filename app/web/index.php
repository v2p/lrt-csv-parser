<?php

use Lrt\DependencyInjection\CommonServiceProvider;
use Lrt\DependencyInjection\ContainerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$configuration = require_once __DIR__ . '/../config/web.php';

$container = (new ContainerFactory())
    ->create($configuration);

/** @var \Silex\Application $silexApplication */
$silexApplication = $container[CommonServiceProvider::SERVICE_WEB_APPLICATION];
$silexApplication->run();

