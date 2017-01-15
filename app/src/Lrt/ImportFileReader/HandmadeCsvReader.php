<?php

namespace Lrt\ImportFileReader;

use Lrt\ImportFileReader\Exceptions\FileIsNotFoundException;
use Lrt\ImportFileReader\Exceptions\FileIsNotReadableException;

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
            throw new FileIsNotFoundException('File is not found');
        }

        if (!is_readable($filePath)) {
            throw new FileIsNotReadableException('File is not readable');
        }

        $fileResource = fopen($filePath, 'r');

        while (($data = fgetcsv($fileResource, null, $delimiter)) !== false) {
            yield $data;
        }

        fclose($fileResource);
    }
}