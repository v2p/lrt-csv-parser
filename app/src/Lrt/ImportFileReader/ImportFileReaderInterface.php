<?php

namespace Lrt\ImportFileReader;

interface ImportFileReaderInterface
{
    /**
     * @param string $filePath
     * @return \Generator
     */
    public function readLines($filePath);
}