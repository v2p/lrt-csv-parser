<?php

namespace Lrt\DependencyInjection;

use Pimple\ServiceProviderInterface;

abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function getConfigValue($key, $default = null)
    {
        return array_key_exists($key, $this->config)
            ? $this->config[$key]
            : $default;
    }
}