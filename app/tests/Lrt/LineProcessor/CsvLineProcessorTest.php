<?php

namespace Lrt\LineProcessor;

use Lrt\LineProcessor\Exceptions\NonValidLineException;

class CsvLineProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsvLineProcessor
     */
    private $lineProcessor;

    const ANY_VALID_LINE_INDEX = 999;

    protected function setUp()
    {
        $this->lineProcessor = new CsvLineProcessor();
    }

    public function testFirstLineShouldBeIgnoredWithException()
    {
        $this->expectException(NonValidLineException::class);

        $this->lineProcessor->createDataItem(0, ['non-empty-data']);
    }

    private function lineCasesGenerator($attributeLineIndex, $cases)
    {
        // generate fake line representing data from CSV filled with 0:
        $rowTemplate = array_fill(0, 14, 0);

        // generate array of lines with test values inserted on expected places in line:
        return array_map(function($case) use ($attributeLineIndex, $rowTemplate) {
            // please note that $rowTemplate passed by value because of "use" and "PHP closure" behavior
            list($testValue, $expectedValue) = $case;
            $rowTemplate[$attributeLineIndex] = $testValue;

            return [$rowTemplate, $expectedValue];
        }, $cases);
    }

    /**
     * @dataProvider providerForShouldParseBLDomProperly
     * @param $line
     * @param $expected
     */
    public function testShouldParseBLDomProperly($line, $expected)
    {
        $dataItem = $this->lineProcessor->createDataItem(self::ANY_VALID_LINE_INDEX, $line);

        $this->assertEquals($expected, $dataItem->getBLDom());
    }

    public function providerForShouldParseBLDomProperly()
    {
        return $this->lineCasesGenerator(6, [
            [0, 0],
            [1, 1],
            ["1", 1],
            ["123,456", 123.456],
        ]);
    }

    /**
     * @dataProvider providerForShouldParseAnchorTextProperly
     * @param $line
     * @param $expected
     */
    public function testShouldParseAnchorTextProperly($line, $expected)
    {
        $dataItem = $this->lineProcessor->createDataItem(self::ANY_VALID_LINE_INDEX, $line);

        $this->assertEquals($expected, $dataItem->getAnchorText());
    }

    public function providerForShouldParseAnchorTextProperly()
    {
        return $this->lineCasesGenerator(3, [
            [null, null],
            ["text", "text"],
            [123, 123],
            ["123,456", "123,456"],
        ]);
    }
}