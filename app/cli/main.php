<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configuration = require_once __DIR__ . '/../config/cli.php';

$container = (new \Lrt\DependencyInjection\ContainerFactory())
    ->create($configuration);

/** @var \Symfony\Component\Console\Application $application */
$application = $container['consoleApplication'];

/** @var \Psr\Log\LoggerInterface $logger */
$logger = $container['logger'];

try {
    $application->setCatchExceptions(false);
    $application->run();
} catch (\Exception $e) {
    $logger->error($e->getMessage());
}