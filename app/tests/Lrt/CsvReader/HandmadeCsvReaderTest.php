<?php

namespace Lrt\CsvReader;

use Lrt\CsvReader\Exceptions\FileIsNotFoundException;
use Lrt\CsvReader\Exceptions\FileIsNotReadableException;
use Lrt\FixtureAwareTrait;

class HandmadeCsvReaderTest extends \PHPUnit_Framework_TestCase
{
    use FixtureAwareTrait;

    /**
     * @var HandmadeCsvReader
     */
    private $reader;

    protected function setUp()
    {
        $this->reader = new HandmadeCsvReader();
    }

    /**
     * @dataProvider providerForReadLinesFromNonExistentFileShouldThrowAnException
     * @param string $fileName
     * @param string $expectedException
     */
    public function testReadLinesFromNonExistentFileShouldThrowAnException($fileName, $expectedException)
    {
        $this->expectException($expectedException);
        // dev note: I prefer to use ::class constant where it's possible rather than hardcoded string

        $generator = $this->reader->readLines($fileName);

        /**
         * Tricky place: we have to force generator execution, otherwise function (wrapped
         * with generator by PHP when we used "yield") will not be executed and as a result
         * exception will not be thrown.
         */
        iterator_to_array($generator);
    }

    public function providerForReadLinesFromNonExistentFileShouldThrowAnException()
    {
        return [
            [
                $this->getFullPathToFixture('non-existent-file.csv'),
                FileIsNotFoundException::class
            ],
            [
                $this->getFullPathToFixture('some_directory'),
                FileIsNotFoundException::class
            ]
        ];
    }

    /**
     * @dataProvider providerForReadLinesShouldReturnCorrectData
     * @param string $fixtureFilename
     * @param array $expectedResult
     */
    public function testReadLinesShouldReturnCorrectData($fixtureFilename, $expectedResult)
    {
        $fixtureFilePath = $this->getFullPathToFixture($fixtureFilename);

        $actualResult = iterator_to_array(
            $this->reader->readLines($fixtureFilePath),
            false
        );

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function providerForReadLinesShouldReturnCorrectData()
    {
        return [
            [
                'case1.csv',
                [
                    [1, 2, 3],
                    [4, 5, 6, 7],
                    [8],
                    [null],
                    [9],
                ]
            ],
            [
                'case2_empty.csv',
                []
            ]
        ];
    }
}