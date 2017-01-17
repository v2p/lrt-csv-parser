<?php

namespace Lrt\LineProcessor;

use Lrt\Entity\DataItem;

interface LineProcessorInterface
{
    /**
     * @param $index 0-based index of current line in source file
     * @param array $line
     * @return DataItem
     */
    public function createDataItem($index, array $line);
}