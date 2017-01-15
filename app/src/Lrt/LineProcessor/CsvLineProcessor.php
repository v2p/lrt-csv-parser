<?php

namespace Lrt\LineProcessor;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class CsvLineProcessor implements LineProcessorInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @param array $values
     */
    public function processValues(array $values)
    {
        $this->logger->info($values[0]);
    }
}