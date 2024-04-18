<?php
include("varequipo.php");
?>

<!-- libreria para mostrar progreso al cargar -->
<script src="grafic/lib/pacejs/pace.min.js"></script>
<link href="grafic/lib/pacejs/pace-theme-loading-bar.css" rel="stylesheet"/>

<script type="text/javascript">
$(function () {
    $.getJSON('grafic/lib/dtos.h.vibr.php?Consultar=1', function (data) {

        $('#container').highcharts({

            chart: {
                type: 'arearange',
                zoomType: 'x'
            },

            title: {
                text: ' Historico de Vibracion '+equipo+' variacion diaria'
            },

            xAxis: {
                type: 'datetime'
            },

            yAxis: {
                title: {
                    text: null
                }
            },

            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: ' mm/s<sup>2</sup>'
            },

            legend: {
                enabled: false
            },

            series: [{
                name: 'Vibracion',
                data: data
            }]

        });
    });

});
</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>





