<?php

namespace Lrt\ChartBuilder\Types;

class BldomByRangeChartBuilder extends AbstractDataItemChartBuilder
{
    /**
     * See config details here: http://www.highcharts.com/demo/bar-basic
     * @return string
     */
    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getBLDomGroupedByRange();

        // array of int items with numerical indexes:
        $data = array_map(
            'intval',
            array_values($allItems)
        );

        $xAxisCategories = [
            '0',
            '1 - 10',
            '11 - 100',
            '=< 1,000',
            '=< 10,000',
            '=< 100,000',
            '=> 100,000'
        ];

        $config = [];

        $config['title']['text'] = '"BLdom" grouped by defined classes';
        $config['chart']['animation'] = true;
        $config['xAxis']['categories'] = $xAxisCategories;
        $config['xAxis']['crosshair'] = true;
        $config['yAxis']['min'] = 0;
        $config['tooltip'] = [
            'headerFormat' => '',
            'pointFormat' => '{point.y}'
        ];
        $config['series'][0] = [
            'name' => 'BLdom',
            'data' => $data
        ];

        return $this->toJson($config);
    }
}