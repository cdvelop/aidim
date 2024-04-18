<?php
include("varmaquina.php");
?>


    <script type="text/javascript">
$(function () {
$(document).ready(function () {



    var gaugeOptions = {
        chart: {
            type: 'solidgauge',
            events: {
            load: requestData
            }
        },
        title: null,
        exporting: {
            enabled: false
            },
        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },
        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    // The speed gauge
    $('#disponivilidad').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            stops: [
                [0.0, '#DF5353'], // ROJO
                [0.75, '#DF5353'], // ROJO
                [0.76, '#DDDF0D'], // AMARILLO
                [0.84, '#DDDF0D'], // AMARILLO
                [0.85, '#55BF3B'], // VERDE
                [1, '#55BF3B'] // VERDE
            ],
            min: 0,
            max: 100,
            title: {
                text: 'Disponibilidad',
                style:{
                    color: '#000000',
                    fontSize: '20px'
                }
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Disponibilidad',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y} %</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' D'
            }
        }]

    }));

    // The ritmo gauge
    $('#ritmo').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            stops: [
                [0.0, '#DF5353'], // ROJO
                [0.8, '#DF5353'], // ROJO
                [0.81, '#DDDF0D'], // AMARILLO
                [0.91, '#DDDF0D'], // AMARILLO
                [0.92, '#55BF3B'], // VERDE
                [1, '#55BF3B'] // VERDE
            ],
            min: 0,
            max: 100,
            title: {
                text: 'Ritmo',
                style:{
                    color: '#000000',
                    fontSize: '20px'
                }
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: 'Ritmo',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y} %</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' R'
            },

        }]

    }));

        // The calidad gauge
    $('#calidad').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            stops: [
                [0.0, '#DF5353'], // ROJO
                [0.85, '#DF5353'], // ROJO
                [0.86, '#DDDF0D'], // AMARILLO
                [0.94, '#DDDF0D'], // AMARILLO
                [0.95, '#55BF3B'], // VERDE
                [1, '#55BF3B'] // VERDE
            ],
            min: 0,
            max: 100,
            title: {
                text: 'Calidad',
                style:{
                    color: '#000000',
                    fontSize: '20px'
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Calidad',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y} %</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' C'
            }
        }]

    }));

        // The oee gauge
    $('#oee').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            stops: [
                [0.0, '#DF5353'], // ROJO
                [0.85, '#DF5353'], // ROJO
                [0.86, '#DDDF0D'], // AMARILLO
                [0.93, '#DDDF0D'], // AMARILLO
                [0.94, '#55BF3B'], // VERDE
                [1, '#55BF3B'] // VERDE
            ],
            min: 0,
            max: 100,
            title: {
                text: 'OEE',
                style:{
                    color: '#0C00FF',
                    fontSize: '20px'
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'OEE',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:30px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || '#0C00FF') + '">{y}  %</span><br/>' +
                       '<span style="font-size:px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: '',
            }
        }]

    }));

function requestData() {

    $.get( "grafic/lib/dtos.kpi.php?Consultar=1", function( UltimosDatos ) {

        // disponivilidad
        var chart = $('#disponivilidad').highcharts(),
            point,
            newdis,
            inc;

        if (chart) {
            point = chart.series[0].points[0];
            inc = UltimosDatos[0] - point.y;
            newdis = point.y + inc;

            if (newdis < 0 || newdis > 100) {
                newdis = point.y - inc;
            }

            point.update(newdis);
        }

        // ritmo
        chart = $('#ritmo').highcharts();
        if (chart) {
            point = chart.series[0].points[0];
            inc = UltimosDatos[1] - point.y;
            newrit = point.y + inc;

            if (newrit < 0 || newrit > 100) {
                newrit = point.y - inc;
            }

            point.update(newrit);
        }



                // calidad
        var chart = $('#calidad').highcharts(),
            point,
            newcal,
            cal;

        if (chart) {
            point = chart.series[0].points[0];
            cal = UltimosDatos[2] - point.y;
            newcal = point.y + cal;

            if (newcal < 0 || newcal > 100) {
                newcal = point.y - cal;
            }

            point.update(newcal);
        }


                // oee
        var num = ((newdis/100)*(newrit/100)*(newcal/100))*100;
        var kpi = num.toFixed(1); // Igual a 5.57


        var chart = $('#oee').highcharts(),
            point,
            newoee,
            oee;

        if (chart) {
            point = chart.series[0].points[0];
            oee = kpi - point.y;
            newoee = point.y + oee;

            if (newoee < 0 || newoee > 100) {
                newoee = point.y - oee;
            }

            point.update(newoee);
        }

        // $(".kpi").html("oee: "+newdis+"*"+newrit+"*"+newcal+" = "+kpi);

        });
    setTimeout(requestData, 3000);  
}



});

});
</script>

<div class="barra">

<div id="oee" style="width: 100%; height: 200px;"></div>
</div>

<div id="oeekpi">

    <div id="disponivilidad" style="width: 300px; height: 200px; float: left; margin: 25px"></div>
    <div id="ritmo" style="width: 300px; height: 200px; float: left;margin: 25px"></div>
    <div id="calidad" style="width: 300px; height: 200px; float: left;margin: 25px"></div>

</div>
     


      

