<?php
include("varmaquina.php");
?>
<!-- libreria para mostrar progreso al cargar -->
<script src="grafic/lib/pacejs/pace.min.js"></script>
<link href="grafic/lib/pacejs/pace-theme-loading-bar.css" rel="stylesheet"/>

		<script type="text/javascript">
$(function () {
    $.getJSON('grafic/lib/dtos.h.oee.php?Consultar=1', function (data) {



        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Historico Anual OEE promedio diario'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'seleccionar para hacer zoom' : 'seleccionar para hacer zoom'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'OEE %'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'oee',
                color: '#5FD82A',
                data: data,
                tooltip: {
                valueSuffix: ' %'
            }
            }]
        });
    });
});
		</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

