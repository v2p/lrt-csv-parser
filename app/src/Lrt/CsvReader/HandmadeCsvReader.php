<?php

namespace Lrt\CsvReader;

use Lrt\CsvReader\Exceptions\FileIsNotFoundException;
use Lrt\CsvReader\Exceptions\FileIsNotReadableException;

class HandmadeCsvReader implements CsvReaderInterface
{
    /**
     * @param string $filePath
     * @param string $delimiter
     * @return \Generator
     */
    public function readLines($filePath, $delimiter = ',')
    {
        if (!is_file($filePath)) {
            throw new FileIsNotFoundException();
        }

        if (!is_readable($filePath)) {
            throw new FileIsNotReadableException();
        }

        $fileResource = fopen($filePath, 'r');

        while (($data = fgetcsv($fileResource, null, $delimiter)) !== false) {
            yield $data;
        }

        fclose($fileResource);
    }
}