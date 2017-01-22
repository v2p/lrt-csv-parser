<?php

namespace Lrt\DataStorage;

use Doctrine\ORM\EntityManager;
use Lrt\Entity\DataItem;

class MySqlDataStorage implements DataStorageInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

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
        $this->connection = $entityManager->getConnection();

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

    private function flushChanges()
    {
        $this->entityManager->flush();
        $this->currentBatchSize = 0;
    }

    public function startImport()
    {
        $this->connection->setAutoCommit(false);
    }

    public function finishImport()
    {
        $this->flushChanges();
        $this->connection->setAutoCommit(true);
    }
}