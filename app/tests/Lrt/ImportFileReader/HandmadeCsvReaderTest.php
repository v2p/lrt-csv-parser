<?php

namespace Lrt\ImportFileReader;

use Lrt\FixtureAwareTrait;
use Lrt\ImportFileReader\Exceptions\FileIsNotFoundException;
use Lrt\ImportFileReader\Exceptions\FileIsNotReadableException;
use org\bovigo\vfs\vfsStream;

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
        $virtualDirectory = vfsStream::setup($this->getFullPathToFixture('subDirectory'));
        $noReadPermissions = 0333; // equals to -wx-wx-wx

        $virtualNonReadableFile = vfsStream::newFile('virtual-non-readable-file.csv', $noReadPermissions)
            ->at($virtualDirectory)
            ->url();

        return [
            [
                $this->getFullPathToFixture('non-existent-file.csv'),
                FileIsNotFoundException::class
            ],
            [
                $this->getFullPathToFixture('some_directory'),
                FileIsNotFoundException::class
            ],
            [
                $virtualNonReadableFile,
                FileIsNotReadableException::class
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