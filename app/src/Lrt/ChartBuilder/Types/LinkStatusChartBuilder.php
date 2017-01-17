<?php

namespace Lrt\ChartBuilder\Types;

use Lrt\ChartBuilder\PieChartAwareTrait;

class LinkStatusChartBuilder extends AbstractDataItemChartBuilder
{
    use PieChartAwareTrait;

    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getLinkStatusGrouped();

        $data = array_map(function ($item) {
            return [
                'name' => utf8_encode($item['text']),
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        $config = $this->getPieChartDefaultConfiguration();

        $config['series'][0]['data'] = $data;

        $config['plotOptions']['pie']['dataLabels'] = [
            'enabled' => true,
            'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
            'style' => [
                'color' => 'black',
            ],
        ];

        return $this->toJson($config);
    }
}