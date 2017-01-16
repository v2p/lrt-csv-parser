<?php

namespace Lrt\DependencyInjection;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Lrt\DataStorage\MySqlDataStorage;
use Pimple\Container;

class DataStorageServiceProvider extends AbstractServiceProvider
{
    const SERVICE_ENTITY_MANAGER = 'data.entityManager';
    const SERVICE_MYSQL_STORAGE = 'data.mysqlStorage';

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
        $pimple[self::SERVICE_ENTITY_MANAGER] = function() {
            $applicationConfig = $this->getConfigValue('entityManager.db');

            $metadataConfig = Setup::createAnnotationMetadataConfiguration(
                [$this->getConfigValue('entityManager.pathToEntityFiles')],
                false
            );

            return EntityManager::create(
                $applicationConfig,
                $metadataConfig
            );
        };

        $pimple[self::SERVICE_MYSQL_STORAGE] = function(Container $c) {
            return new MySqlDataStorage(
                $c[self::SERVICE_ENTITY_MANAGER]
            );
        };
    }
}