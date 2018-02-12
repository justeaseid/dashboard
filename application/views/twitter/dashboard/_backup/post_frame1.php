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
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: [{
                            name: 'Video',
//                           
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
//                            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                        }, {
                            name: 'Photo',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 17, 18, 9, 0]
                        }, {
                            name: 'Status',
                            data: [ 0, 0, 0, 0, 0, 0, 0, 0, 17, 18, 9, 0]
                        }, {
                            name: 'Link',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 82, 67, 35, 0 ]
                        }, {
                            name: 'Offer',
                            data: [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        }]
                });
            });
        </script>
    </head>
    <body>
        <script src="<?php echo HIGHCHART; ?>/highcharts.js"></script>
        <script src="<?php echo HIGHCHART_MODULES; ?>/exporting.js"></script>

        <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
