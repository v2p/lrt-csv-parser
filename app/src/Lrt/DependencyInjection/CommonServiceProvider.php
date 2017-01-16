<?php

namespace Lrt\DependencyInjection;

use Lrt\Importer;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class CommonServiceProvider extends AbstractServiceProvider
{
    const SERVICE_LOGGER = 'logger';
    const SERVICE_CONSOLE_APPLICATION = 'consoleApplication';

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple[self::SERVICE_LOGGER] = function() {
            $logger = new Logger('logger');
            $loggerFormatter = new LineFormatter("[%datetime%] %message%\n");

            $infoHandler = new StreamHandler('php://stdout', Logger::INFO);
            $infoHandler->setFormatter($loggerFormatter);

            $logger->pushHandler($infoHandler);

            return $logger;
        };

        $pimple[self::SERVICE_CONSOLE_APPLICATION] = function(Container $c) {
            $application = new Application('lrt-csv-importer', '1.0.0');

            $application
                ->register('run')
                ->addArgument('file', InputArgument::REQUIRED)
                ->setCode(function(InputInterface $input/*, OutputInterface $output*/) use ($c) {
                    /** @var Importer $importer */
                    $importer = $c[CsvServiceProvider::SERVICE_CSV_IMPORTER];
                    $importer->run(
                        $input->getArgument('file')
                    );
                })
                ->getApplication()
                ->setDefaultCommand('run', true);

            return $application;
        };
    }
}