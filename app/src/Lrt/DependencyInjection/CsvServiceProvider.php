<?php

namespace Lrt\DependencyInjection;

use Lrt\Importer;
use Lrt\ImportFileReader\HandmadeCsvReader;
use Lrt\LineProcessor\CsvLineProcessor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CsvServiceProvider implements ServiceProviderInterface
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
        $pimple['csv.reader'] = function () {
            return new HandmadeCsvReader();
        };

        $pimple['csv.lineProcessor'] = function (Container $c) {
            $lineProcessor = new CsvLineProcessor();
            $lineProcessor->setLogger($c['logger']);

            return $lineProcessor;
        };

        $pimple['csv.importer'] = function(Container $c) {
            return new Importer(
                $c['csv.reader'],
                $c['csv.lineProcessor'],
                $c['logger']
            );
        };
    }
}