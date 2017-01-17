<?php

namespace Lrt\ChartBuilder;

use Lrt\ChartBuilder\Exceptions\ChartBuilderNotFoundException;
use Lrt\Repository\DataItemRepository;

class ChartBuilderFactory
{
    /**
     * @var DataItemRepository
     */
    private $dataItemRepository;

    /**
     * @var ChartBuilderInterface[]
     */
    private $chartBuilders = [];

    public function __construct(DataItemRepository $dataItemRepository)
    {
        $this->dataItemRepository = $dataItemRepository;
        $this->registerChartBuilders();
    }

    private function registerChartBuilders()
    {
        $this->chartBuilders = [
            'anchorChart' => new AnchorTextChartBuilder($this->dataItemRepository),
            'linkStatusChart' => new LinkStatusChartBuilder($this->dataItemRepository),
        ];
    }

    /**
     * @param string $type
     * @return ChartBuilderInterface
     */
    public function getChartBuilder($type)
    {
        if (!array_key_exists($type, $this->chartBuilders)) {
            throw new ChartBuilderNotFoundException();
        }

        return $this->chartBuilders[$type];
    }
}