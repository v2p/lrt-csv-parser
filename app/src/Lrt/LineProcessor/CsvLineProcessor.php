<?php

namespace Lrt\LineProcessor;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class CsvLineProcessor implements LineProcessorInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    const COLUMN_FAVORITES = 0;
    const COLUMN_FROM_URL = 1;
    const COLUMN_TO_URL = 2;
    const COLUMN_ANCHOR_TEXT = 3;
    const COLUMN_LINK_STATUS = 4;
    const COLUMN_TYPE = 5;
    const COLUMN_BLDOM = 6;
    const COLUMN_DOMPOP = 7;
    const COLUMN_POWER = 8;
    const COLUMN_TRUST = 9;
    const COLUMN_POWER_TRUST = 10;
    const COLUMN_ALEXA = 11;
    const COLUMN_IP = 12;
    const COLUMN_COUNTRY = 13;

    /**
     * @param $index 0-based index of current line in source file
     * @param array $line
     */
    public function processValues($index, array $line)
    {
        $this->logger->info(
            $this->extractValue(self::COLUMN_ANCHOR_TEXT, $line)
        );
    }

    /**
     * @param int|string $columnIndex
     * @param array $line
     * @param mixed|null $default
     * @return mixed|null
     */
    private function extractValue($columnIndex, array $line, $default = null)
    {
        return array_key_exists($columnIndex, $line)
            ? $line[$columnIndex]
            : $default;
    }
}