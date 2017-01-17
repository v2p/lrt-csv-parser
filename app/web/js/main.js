(function(Highcharts, $, exports) {
    exports.buildTagsCloud = function(jquerySelector, config) {
        jquerySelector.jQCloud(
            config.data,
            config.options || {}
        );
    };

    exports.buildPieChart = function (containerId, config) {
        Highcharts.chart(containerId, config);
    };

    exports.buildBarChart = function (containerId, data) {
        Highcharts.chart(containerId, {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Historic World Population by Region'
            },
            subtitle: {
                text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
            },
            xAxis: {
                categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' millions'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: data
        });
    }
}(window.Highcharts, jQuery, window));