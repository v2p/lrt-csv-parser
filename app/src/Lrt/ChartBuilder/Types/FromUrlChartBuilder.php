<?php

namespace Lrt\ChartBuilder\Types;

class FromUrlChartBuilder extends AbstractDataItemChartBuilder
{

    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getFromUrlGroupedByHost();

        $data = array_map(function ($item) {
            return [
                'name' => $item['host'],
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        $config = [];
        $config['series'][0] = [
            'data' => $data,
            'turboThreshold' => 0,
        ];

        return $this->toJson($config);
    }
}