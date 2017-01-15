<?php

use Lrt\DependencyInjection\CommonServiceProvider;
use Lrt\DependencyInjection\ContainerFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$configuration = require_once __DIR__ . '/../config/cli.php';

$container = (new ContainerFactory())
    ->create($configuration);

/** @var Application $application */
$application = $container[CommonServiceProvider::SERVICE_CONSOLE_APPLICATION];

/** @var LoggerInterface $logger */
$logger = $container[CommonServiceProvider::SERVICE_LOGGER];

try {
    $application->setCatchExceptions(false);
    $application->run();
} catch (\Exception $e) {
    $logger->error($e->getMessage());
}