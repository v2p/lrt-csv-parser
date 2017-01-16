<?php

namespace Lrt\DataStorage;

use Doctrine\ORM\EntityManager;
use Lrt\Entities\DataItem;

class MySqlDataStorage implements DataStorageInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var int
     */
    private $batchSizeToFlush;

    /**
     * @var int
     */
    private $currentBatchSize = 0;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->batchSizeToFlush = 1000;
    }

    public function addDataItem(DataItem $dataItem)
    {
        $this->entityManager->persist($dataItem);
        $this->currentBatchSize++;

        if ($this->currentBatchSize > $this->batchSizeToFlush) {
            $this->flushChanges();
        }
    }

    public function flushChanges()
    {
        $this->entityManager->flush();
        $this->currentBatchSize = 0;
    }
}