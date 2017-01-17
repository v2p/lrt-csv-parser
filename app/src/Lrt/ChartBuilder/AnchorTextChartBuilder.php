<?php

namespace Lrt\ChartBuilder;

class AnchorTextChartBuilder extends AbstractDataItemChartBuilder
{
    public function buildChartData()
    {
        $allItems = $this->dataItemRepository->getAnchorsTextGrouped();

        $data = array_map(function($item) {
            return [
                'text' => utf8_encode($item['text']),
                'weight' => $item['count'],
            ];
        }, $allItems);

        return $this->toJson($data);
    }
}