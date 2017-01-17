<?php

namespace Lrt\ChartBuilder\Types;

class AnchorTextChartBuilder extends AbstractDataItemChartBuilder
{
    public function buildChartConfig()
    {
        $allItems = $this->dataItemRepository->getAnchorsTextGrouped();

        $data = array_map(function($item) {
            return [
                'text' => utf8_encode($item['text']),
                'weight' => (int)$item['count'],
            ];
        }, $allItems);

        $config = [
            'data' => $data
        ];

        return $this->toJson($config);
    }
}