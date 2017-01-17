<?php

namespace Lrt\DataStorage;

use Lrt\Entity\DataItem;

interface DataStorageInterface
{
    public function addDataItem(DataItem $dataItem);

    public function flushChanges();
}