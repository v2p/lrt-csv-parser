<?php

namespace Lrt\DependencyInjection;

use Doctrine\ORM\EntityManager;
use Lrt\ChartBuilder\ChartBuilderFactory;
use Lrt\Entity\DataItem;
use Lrt\Repository\DataItemRepository;
use Pimple\Container;

class ChartBuilderServiceProvider extends AbstractServiceProvider
{
    const SERVICE_CHART_BUILDER_FACTORY = 'chartBuilder.factory';

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
        $pimple[self::SERVICE_CHART_BUILDER_FACTORY] = function(Container $c) {
            /** @var EntityManager $entityManager */
            $entityManager = $c[DataStorageServiceProvider::SERVICE_ENTITY_MANAGER];
            /** @var DataItemRepository $repository */
            $repository = $entityManager->getRepository(DataItem::class);

            return new ChartBuilderFactory($repository);
        };
    }
}