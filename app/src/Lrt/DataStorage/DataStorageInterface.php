<?php

namespace Lrt\DataStorage;

use Lrt\Entities\DataItem;

interface DataStorageInterface
{
    public function addDataItem(DataItem $dataItem);

    public function flushChanges();
}