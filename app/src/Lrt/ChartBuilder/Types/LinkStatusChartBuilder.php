<?php

namespace Lrt\ChartBuilder\Types;

class LinkStatusChartBuilder extends AbstractDataItemChartBuilder
{
    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getLinkStatusGrouped();

        $data = array_map(function ($item) {
            return [
                'name' => $item['text'],
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        $config = [];
        $config['series'][0]['data'] = $data;

        return $this->toJson($config);
    }
}