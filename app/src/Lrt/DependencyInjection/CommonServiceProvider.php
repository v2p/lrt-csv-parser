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
        $pimple['logger'] = function() {
            $logger = new Logger('logger');

            $loggerHandler = new StreamHandler('php://stdout', Logger::INFO);
            $loggerHandler->setFormatter(
                new LineFormatter("[%datetime%] %message%\n")
            );

            $logger->pushHandler($loggerHandler);

            return $logger;
        };

        $pimple['consoleApplication'] = function(Container $c) {
            $application = new Application('lrt-csv-importer', '1.0.0');

            $application
                ->register('run')
                ->addArgument('file', InputArgument::REQUIRED)
                ->setCode(function(InputInterface $input/*, OutputInterface $output*/) use ($c) {
                    /** @var Importer $importer */
                    $importer = $c['csv.importer'];
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