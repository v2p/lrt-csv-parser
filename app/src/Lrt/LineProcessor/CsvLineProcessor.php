<?php

namespace Lrt\LineProcessor;

use Lrt\Entity\DataItem;
use Lrt\LineProcessor\Exceptions\NonValidLineException;
use NumberFormatter;

class CsvLineProcessor implements LineProcessorInterface
{
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

    const CSV_HEADER_LINE_INDEX = 0;

    /**
     * @var NumberFormatter
     */
    private $decimalNumberFormatter;

    public function __construct()
    {
        $this->decimalNumberFormatter = new NumberFormatter('de_DE', NumberFormatter::DECIMAL);
    }

    /**
     * @param $index 0-based index of current line in source file
     * @param array $line
     * @return DataItem
     */
    public function createDataItem($index, array $line)
    {
        if ($index == self::CSV_HEADER_LINE_INDEX) {
            throw new NonValidLineException('Skip header line');
        }

        return new DataItem(
            $this->extractValue(self::COLUMN_ANCHOR_TEXT, $line),
            $this->extractValue(self::COLUMN_LINK_STATUS, $line),
            $this->extractValue(self::COLUMN_FROM_URL, $line),
            $this->extractBLDom($line)
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

    private function extractBLDom($line)
    {
        $value = $this->extractValue(self::COLUMN_BLDOM, $line);

        return $this->decimalNumberFormatter->parse($value);
    }
}