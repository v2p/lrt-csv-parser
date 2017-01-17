<?php

namespace Lrt\DependencyInjection;

use Lrt\ChartBuilder\ChartBuilderFactory;
use Lrt\Importer;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

class CommonServiceProvider extends AbstractServiceProvider
{
    const SERVICE_LOGGER = 'logger';
    const SERVICE_CONSOLE_APPLICATION = 'consoleApplication';
    const SERVICE_WEB_APPLICATION = 'webApplication';
    const SERVICE_TEMPLATE_ENGINE = 'templateEngine';

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $container A container instance
     */
    public function register(Container $container)
    {
        $this->registerLogger($container);
        $this->registerConsoleApplication($container);
        $this->registerTemplateEngine($container);
        $this->registerWebApplication($container);
    }

    /**
     * @param Container $container
     */
    private function registerLogger(Container $container)
    {
        $container[self::SERVICE_LOGGER] = function () {
            $logger = new Logger('logger');
            $loggerFormatter = new LineFormatter("[%datetime%] %message%\n");

            $infoHandler = new StreamHandler('php://stdout', Logger::INFO);
            $infoHandler->setFormatter($loggerFormatter);

            $logger->pushHandler($infoHandler);

            return $logger;
        };
    }

    /**
     * @param Container $container
     */
    private function registerConsoleApplication(Container $container)
    {
        $container[self::SERVICE_CONSOLE_APPLICATION] = function (Container $c) {
            $application = new Application('lrt-csv-importer', '1.0.0');

            $application
                ->register('run')
                ->addArgument('file', InputArgument::REQUIRED)
                ->setCode(function (InputInterface $input/*, OutputInterface $output*/) use ($c) {
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

    /**
     * @param Container $container
     */
    private function registerTemplateEngine(Container $container)
    {
        $container[self::SERVICE_TEMPLATE_ENGINE] = function () {
            return new Twig_Environment(
                new Twig_Loader_Filesystem(
                    $this->getConfigValue('templateEngine.pathToTemplates')
                )
            );
        };
    }

    /**
     * @param Container $container
     */
    private function registerWebApplication(Container $container)
    {
        $container[self::SERVICE_WEB_APPLICATION] = function(Container $c) {
            /** @var Twig_Environment $templateEngine */
            $templateEngine = $c[self::SERVICE_TEMPLATE_ENGINE];

            /** @var ChartBuilderFactory $chartBuilderFactory */
            $chartBuilderFactory = $c[ChartBuilderServiceProvider::SERVICE_CHART_BUILDER_FACTORY];

            $application = new \Silex\Application();
            $application->get('/', function () use ($templateEngine, $chartBuilderFactory) {
                return $templateEngine->render('index.twig', [
                    'anchorChartData' => $chartBuilderFactory->getChartBuilder('anchorText')->buildChartData()
                ]);
            });

            return $application;
        };
    }
}