<?php

namespace Lrt\ChartBuilder\Types;

class LinkStatusChartBuilder extends AbstractDataItemChartBuilder
{
    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getLinkStatusGrouped();

        $data = array_map(function ($item) {
            return [
                'name' => utf8_encode($item['text']),
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        $config = [];

        $config['title']['text'] = '"Link Status"';

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