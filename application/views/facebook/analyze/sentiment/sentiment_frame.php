<!DOCTYPE HTML>
<html>
    <head>
        <script type="text/javascript" src="<?php echo HIGHCHART; ?>/jquery.min.js"></script>

        <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    title: {
                        text: '',
                    },
                    subtitle: {
                        text: '',
                    },
                    credits: {
                        enabled: false
                    },
                    exporting: {
                        enabled: false
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yAxis: {
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'top',
                        borderWidth: 0
                    },
                    series: [{
                            name: 'Positive',
                            data: [<?php echo $pos;?>],
                            color: '#3c8dbc'
                        }, {
                            name: 'Negative',
                            data: [<?php echo $neg;?>],
                            color: '#de3e00'
                        }, {
                            name: 'Neutral',
                            data: [<?php echo $neu;?>],
                            color: '#404040'
                        }
                        ]
                });
            });
        </script>
    </head>
    <body>
        <script src="<?php echo HIGHCHART; ?>/highcharts.js"></script>
        <script src="<?php echo HIGHCHART_MODULES; ?>/exporting.js"></script>

        <div id="container" style="min-width: 300px; height: 350px; margin: 0 auto"></div>

    </body>
</html>