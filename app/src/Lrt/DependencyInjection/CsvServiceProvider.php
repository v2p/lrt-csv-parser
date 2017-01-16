<?php

namespace Lrt\DependencyInjection;

use Lrt\Importer;
use Lrt\ImportFileReader\HandmadeCsvReader;
use Lrt\LineProcessor\CsvLineProcessor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CsvServiceProvider implements ServiceProviderInterface
{
    const SERVICE_CSV_LINE_PROCESSOR = 'csv.lineProcessor';
    const SERVICE_CSV_READER = 'csv.reader';
    const SERVICE_CSV_IMPORTER = 'csv.importer';

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
        $pimple[self::SERVICE_CSV_READER] = function () {
            return new HandmadeCsvReader();
        };

        $pimple[self::SERVICE_CSV_LINE_PROCESSOR] = function () {
            return new CsvLineProcessor();
        };

        $pimple[self::SERVICE_CSV_IMPORTER] = function(Container $c) {
            return new Importer(
                $c[self::SERVICE_CSV_READER],
                $c[self::SERVICE_CSV_LINE_PROCESSOR],
                $c[DataStorageServiceProvider::SERVICE_MYSQL_STORAGE],
                $c[CommonServiceProvider::SERVICE_LOGGER]
            );
        };
    }
}