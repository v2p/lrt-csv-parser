<?php

namespace Lrt\ChartBuilder\Types;

use Lrt\ChartBuilder\PieChartAwareTrait;

class FromUrlChartBuilder extends AbstractDataItemChartBuilder
{
    use PieChartAwareTrait;

    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getFromUrlGroupedByHost();

        $data = array_map(function ($item) {
            return [
                'name' => utf8_encode($item['host']),
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        $config = $this->getPieChartDefaultConfiguration();

        $config['series'][0]['data'] = $data;
        $config['series'][0]['turboThreshold'] = 0;

        $config['plotOptions']['pie']['allowPointSelect'] = false;
        $config['plotOptions']['pie']['animation'] = false;

        return $this->toJson($config);
    }
}