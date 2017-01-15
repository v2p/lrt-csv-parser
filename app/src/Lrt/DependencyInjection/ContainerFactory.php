<?php

namespace Lrt\DependencyInjection;

use Pimple\Container;

class ContainerFactory
{
    /**
     * @param array $config
     * @return Container
     */
    public function create(array $config = [])
    {
        $container = new Container();
        $container->register(new CommonServiceProvider($config));
        $container->register(new CsvServiceProvider($config));

        return $container;
    }
}