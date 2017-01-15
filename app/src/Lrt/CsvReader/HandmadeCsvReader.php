<?php

namespace Lrt\CsvReader;

use Lrt\ImportFileReader\Exceptions\FileIsNotFoundException;
use Lrt\ImportFileReader\Exceptions\FileIsNotReadableException;
use Lrt\ImportFileReader\ImportFileReaderInterface;

class HandmadeCsvReader implements ImportFileReaderInterface
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