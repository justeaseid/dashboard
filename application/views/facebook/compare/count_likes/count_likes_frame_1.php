<!DOCTYPE HTML>
<html>
    <head>
        
        <script type="text/javascript" src="<?php echo HIGHCHART; ?>/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                // Create the chart
                $('#container').highcharts({
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: ''
                    },
                    credits: {
                        enabled: false
                    },
                    exports: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                    },
                    series: [{
                            name: "Comment Action",
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

        <div id="container" style="min-width: 310px; max-width: 310px; height: 280px; margin: 0 auto"></div>


    </body>
</html>
