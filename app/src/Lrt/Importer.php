<?php

namespace Lrt;

use Lrt\DataStorage\DataStorageInterface;
use Lrt\ImportFileReader\Exceptions\ImportFileReaderExceptionInterface;
use Lrt\ImportFileReader\ImportFileReaderInterface;
use Lrt\LineProcessor\Exceptions\LineProcessorExceptionInterface;
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
     * @var DataStorageInterface
     */
    private $dataStorage;

    /**
     * @param ImportFileReaderInterface $importFileReader
     * @param LineProcessorInterface $lineProcessor
     * @param DataStorageInterface $dataStorage
     * @param LoggerInterface $logger
     */
    public function __construct(
        ImportFileReaderInterface $importFileReader,
        LineProcessorInterface $lineProcessor,
        DataStorageInterface $dataStorage,
        LoggerInterface $logger
    ) {
        $this->importFileReader = $importFileReader;
        $this->lineProcessor = $lineProcessor;
        $this->dataStorage = $dataStorage;
        $this->logger = $logger;
    }

    public function run($inputFile)
    {
        $this->logger->info('Process started...');

        try {
            foreach ($this->importFileReader->readLines($inputFile) as $index => $line) {
                try {
                    $dataItem = $this->lineProcessor->createDataItem($index, $line);
                    $this->dataStorage->addDataItem($dataItem);
                } catch (LineProcessorExceptionInterface $exception) {
                    $this->logger->error($exception->getMessage());
                }
            }

            $this->dataStorage->flushChanges();

        } catch (ImportFileReaderExceptionInterface $exception) {
            $this->logger->error($exception->getMessage());
        }

        $this->logger->info('Process finished.');
    }
}