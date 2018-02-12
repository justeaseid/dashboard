<!DOCTYPE HTML>
<!--

{
    name: "link",
    y: 56.33,
    color: '#606060'
}, {
    name: "video",
    y: 24.03,
    color: '#606060'
}, {
    name: "photo",
    y: 10.38,
    color: '#606060'
}, {
    name: "status",
    y: 9.38,
    color: '#606060'
}
-->

<html>
    <head>
        <script type="text/javascript" src="<?php echo HIGHCHART; ?>/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                // Create the chart
                $('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: ''
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: false,
                                format: '{point.y}'
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                    },
                    series: [{
                            name: "Comment",
                            colorByPoint: true,
                            data: [<?php echo $data;?>]
                        }],
                    drilldown: {
                        series: []
                    }
                });
            });
        </script>
    </head>
    <body>
        <script src="<?php echo HIGHCHART; ?>/highcharts.js"></script>
        <script src="<?php echo HIGHCHART_MODULES; ?>/data.js"></script>
        <script src="<?php echo HIGHCHART_MODULES; ?>/drilldown.js"></script>

        <div id="container" style="min-width: 200px; height: 283px; margin: 0 auto"></div>
    </body>
</html>
