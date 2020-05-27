<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.form.js')?>"></script>
    <!-- Google Charts js -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    
    $(document).ready(function(){
        google.charts.setOnLoadCallback(function() {drawChart(column_data,"Values",['#297ef6', '#e52b4c', '#32c861'])});
        google.charts.load('current', {packages: ['corechart']});
        function drawChart(data,axislabel,colors) {
        var options = {
            fontName: 'Open Sans',
            height: 400,
            fontSize: 13,
            chartArea: {
                left: '5%',
                width: '90%',
                height: 350
            },
            tooltip: {
                textStyle: {
                    fontName: 'Open Sans',
                    fontSize: 14
                }
            },
            vAxis: {
                title: axislabel,
                titleTextStyle: {
                    fontSize: 14,
                    italic: false
                },
                gridlines:{
                    color: '#f5f5f5',
                    count: 10
                },
                minValue: 0
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    fontSize: 13
                }
            },
            colors: colors
        };
      var ct = google.visualization.arrayToDataTable(data);
      // Instantiate and draw the chart.
      var chart = new google.visualization.ColumnChart(document.getElementById('column-chart'));
      chart.draw(ct, options);
    }
    })
    
    
    
</script>
</body>
</html>