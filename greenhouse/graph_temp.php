<?php 
    // Start MySQL Connection
    include('dbconnect.php'); 
	
    $data_points = array();
    
    $result = mysqli_query($dbh,"SELECT celsius FROM temperature ORDER BY id ASC");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array($row['celsius']);
        array_push($data_points, $point);      		
    }

?>
 
<html>
<head>
<title>Highcharts Parameters</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="highcharts/code/highcharts.js"></script>  
</head>
<body>
<div id="container" style="width: 720px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
$(document).ready(function() { 
   var chart = {
      type: 'spline',
	  animation: Highcharts.svg, // don't animate in IE < IE 10.
      marginRight: 10,
	  events: {
         load: function () {
            // set up the updating of the chart each second
            var series = this.series[0];
			var data_points= <?php echo json_encode($data_points ); ?>;
            setInterval(function () {
               var x = (new Date()).getTime(), // current time
               y = parseFloat(data_points[data_points.length-1]);
               series.addPoint([x, y], true, true);
            }, 3000);
         }
      }
   };
   var title = {
      text: 'Average Temperature VS. RealTime'   
   };   
   var xAxis = {
	  title: {
		text: 'Time(hr:min:sec)'
	  },
      type: 'datetime',
      tickPixelInterval: 150
   };
   var yAxis = {
      title: {
         text: 'Average Temperature (celsius)'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };
   var tooltip = {
      formatter: function () {
      return '<b>' + this.series.name + '</b><br/>' +
         Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
         Highcharts.numberFormat(this.y, 2);
      }
   };
   var plotOptions = {
      area: {
         pointStart: 1940,
         marker: {
            enabled: false,
            symbol: 'circle',
            radius: 2,
            states: {
               hover: {
                 enabled: true
               }
            }
         }
      }
   };
   var legend = {
      enabled: false
   };
   var exporting = {
      enabled: false
   };
   var series= [{
      name: 'Temperature',
      data: (function () {
         // load data from database
         var data = [],time = (new Date()).getTime(),i;
         for (i = -24; i <= 0; i += 1) {
            data.push({
               x: time + i * 1000,
               y: 0
            });
         }
         return data;
      }())    
   }];     
      
   var json = {};   
   json.chart = chart; 
   json.title = title;     
   json.tooltip = tooltip;
   json.xAxis = xAxis;
   json.yAxis = yAxis; 
   json.legend = legend;  
   json.exporting = exporting;   
   json.series = series;
   json.plotOptions = plotOptions;
   
   
   Highcharts.setOptions({
      global: {
         useUTC: false
      }
   });
   $('#container').highcharts(json);
  
});
</script>
</body>
</html>



