<?php

namespace Lrt\ChartBuilder;

class LinkStatusChartBuilder extends AbstractDataItemChartBuilder
{
    public function buildChartData()
    {
        $allItems = $this->dataItemRepository->getLinkStatusGrouped();

        $data = array_map(function ($item) {
            return [
                'name' => utf8_encode($item['text']),
                'y' => (int)$item['count'],
            ];
        }, $allItems);

        return $this->toJson($data);
    }
}