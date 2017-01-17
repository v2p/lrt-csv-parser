(function(Highcharts, $, exports) {
    exports.buildTagsCloud = function(jquerySelector, config) {
        jquerySelector.jQCloud(
            config.data,
            $.extend(true, {}, config.options)
        );
    };

    exports.buildChart = function (containerId, clientSideConfig, serverSideConfig) {
        Highcharts.chart(
            containerId,
            $.extend(true, {}, clientSideConfig, serverSideConfig)
        );
    };

}(window.Highcharts, jQuery, window));