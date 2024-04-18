<?php
include("varequipo.php");
?>
		<script type="text/javascript">
	// resetear animacion
	// $("#page-wrapper").resetKeyframe();
	$("#page-wrapper").pauseKeyframe();

		$(document).ready(function() {

			
		    chart = new Highcharts.Chart({
		        chart: {
		            renderTo: 'container',
		            defaultSeriesType: 'spline',
		            events: {
		            load: requestData
		            }
		        },
		        title: {
		            text: 'Temperatura '+equipo
		        },
		        xAxis: {
		            type: 'datetime',
		            tickPixelInterval: 150
		            // maxZoom: 20 * 3600
		        },
		        yAxis: {
		            minPadding: 0.2,
		            maxPadding: 0.2,
		            title: {
		                text: 'Temperatura Cº',
		                margin: 80
		            }
		        
				},
            	series: [{
		            name: 'datos en linea Cº',
		            color: '#F90404',
		            data: []
		        }]
		    });        
		});

	
		function requestData() {
		    $.ajax({
		        url: 'grafic/lib/dtos.realt.php',
		        success: function(point) {
		            var series = chart.series[0],
		                shift = series.data.length > 60;  

		 
		            chart.series[0].addPoint(point, true, shift);
		            
		            
		            setTimeout(requestData, 2000);    
		        },
		        cache: false
		    });
		}


		</script>



<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
