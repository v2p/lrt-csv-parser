<?php

namespace Lrt\CsvReader;

interface CsvReaderInterface
{
    /**
     * @param string $filePath
     * @return \Generator
     */
    public function readLines($filePath);
}