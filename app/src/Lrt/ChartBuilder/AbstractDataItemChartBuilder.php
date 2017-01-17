<?php

namespace Lrt\ChartBuilder;

use Lrt\ChartBuilder\Exceptions\ChartDataProcessingException;
use Lrt\Repository\DataItemRepository;

abstract class AbstractDataItemChartBuilder implements ChartBuilderInterface
{
    /**
     * @var DataItemRepository
     */
    protected $dataItemRepository;

    public function __construct(DataItemRepository $dataItemRepository)
    {
        $this->dataItemRepository = $dataItemRepository;
    }

    protected function toJson($data)
    {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ChartDataProcessingException(json_last_error_msg());
        }

        return $json;
    }
}