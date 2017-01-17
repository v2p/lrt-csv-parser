<?php


namespace Lrt\ChartBuilder;

trait PieChartAwareTrait
{
    protected function getPieChartDefaultConfiguration()
    {
        return [
            'chart' => [
                'plotBackgroundColor' => null,
                'plotBorderWidth' => null,
                'plotShadow' => false,
                'animation' => false,
                'type' => 'pie',
            ],
            'title' => false,
            'tooltip' => [
                'pointFormat' => '{point.percentage:.1f}%',
            ],
            'plotOptions' => [
                'pie' => [
                    'allowPointSelect' => false,
                    'cursor' => 'pointer',
                    'dataLabels' => false,
                ],
            ]
        ];
    }
}