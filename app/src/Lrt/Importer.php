<?php

namespace Lrt;

use Lrt\ImportFileReader\Exceptions\ImportFileReaderExceptionInterface;
use Lrt\ImportFileReader\ImportFileReaderInterface;
use Lrt\LineProcessor\LineProcessorInterface;
use Psr\Log\LoggerInterface;

class Importer
{
    /**
     * @var ImportFileReaderInterface
     */
    private $importFileReader;

    /**
     * @var LineProcessorInterface
     */
    private $lineProcessor;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ImportFileReaderInterface $importFileReader
     * @param LineProcessorInterface $lineProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        ImportFileReaderInterface $importFileReader,
        LineProcessorInterface $lineProcessor,
        LoggerInterface $logger
    ) {
        $this->importFileReader = $importFileReader;
        $this->lineProcessor = $lineProcessor;
        $this->logger = $logger;
    }

    public function run($inputFile)
    {
        try {
            foreach ($this->importFileReader->readLines($inputFile) as $line) {
                $this->lineProcessor->processValues($line);
            }
        } catch (ImportFileReaderExceptionInterface $exception) {
            $this->logger->error($exception->getMessage());
        }
    }
}