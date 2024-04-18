


<?php

switch ($_GET['mostrar']) {
    
    case 1:
    echo "<script type='text/javascript'>var equipo = 'M-2302.01';</script>";
    echo "<script type='text/javascript'>    

    var ruta = 'lib/';
    
    var alarmaOnOff = 0;

    var texrigth = '';

    var col ='#BEDEB6';//verde
    var seg = '20s';
    temctrl(ruta);";

        break;
    
    default:

    include("varequipo.php");
    echo '<link href="grafic/lib/css/ctrol.css" rel="stylesheet">';

    echo '<div id="temctrl" style="min-width: 360px; max-width: 450px; height: 350px; margin: 0 auto"></div>';
    echo '<center>';
    echo '<div class="barrat">';
    echo '<div class="vart">Cº</div>';
    echo '<div class="alat">estado de equipo</div>';
    echo '</div>';
    echo '</center>';
    echo "<script type='text/javascript'>
    
    var ruta = 'grafic/lib/';
    
    var alarmaOnOff = 1;

    var texrigth = ' Cº';

    var col ='#BEDEB6';//verde
    var seg = '20s';
    temctrl(ruta);";

        break;
}

?>

  function temctrl(ruta){

          Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
 
        $.ajax({
                url: ruta+"dtos.temctrl.php",
                type: 'get',
                success: function(Dato) {


    $('#temctrl').highcharts({
        legend: {
            enabled: true
        },

        chart: {
            type: 'gauge',
            backgroundColor:'rgba(255, 255, 255, 0.0)',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Temperatura '+equipo
        },
        exporting: {
            enabled: false
        },
        subtitle: {
            text: 'date'
        }, 
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: 'rgba(255, 162, 0, 0.3)',
                borderWidth: 0,
                outerRadius: '109%'
            }, 
                // default background
            {
                backgroundColor: 'rgba(0, 0, 0, 10)',
                borderWidth: 3,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 140,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#FFA200',

            tickPixelInterval: 30,
            tickWidth: 1,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#FFA200',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Cº'
            },
            plotBands: [{
                from: 0,
                to: 60,
                color: '#55BF3B' // green
            }, {
                from: 60,
                to: 80,
                color: '#DDDF0D' // yellow
            }, {
                from: 80,
                to: 140,
                color: '#DF5353' // red
            }]
        },
        credits: {
            enabled: false
        },

        series: [{
            name: 'Temperatura',
            data: Dato,
            tooltip: {
                valueSuffix: ' Cº'
            }
        },{
            showInLegend: true,
            name: "Bueno",
            color: '#55BF3B' // green   
        },{
            showInLegend: true,
            name: "Alerta",
            color: '#DDDF0D' // yellow  
        },{
            showInLegend: true,
            name: "Peligro",
            color: '#DF5353' // red  
        }]

    },
    // Add some life
    function (chart) {
        if (!chart.renderer.forExport) {
            setInterval(function () {
                $.get( ruta+"dtos.temctrl.php?Consultar=1", function( UltimosDatos ) {
                var point = chart.series[0].points[0],
                    newVal,                

                inc = UltimosDatos - point.y; 
                

                newVal = point.y + inc;
                if (newVal < 0 || newVal > 140) {
                    newVal = point.y - inc;
                }
            
                
                var f = Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', (new Date()).getTime());
                chart.setTitle(null, { text: f});   

                
                //codigo fondo alarma******************
                var ala = "estado de temperatura equipo: normal";

                if (newVal>60){
                if(alarmaOnOff==1){
                seg = '5s';
                col ='#DDDF0D';}//amarillo
                ala = "alarma de temperatura: revisar equipo";  
                }

                if (newVal>80){
                if(alarmaOnOff==1){
                seg = '2s';
                col ='#DF5353';}//rojo
                ala = "alarma de temperatura: detener equipo";   
                }
                
                if(alarmaOnOff==1){
                // cambiar propiedades de color fondo
                // https://github.com/Keyframes/jQuery.Keyframes

                

                $('#page-wrapper').playKeyframe([
                    'rgb 1s infinite alternate',
                    {
                      name: 'rgb',
                      duration: seg,
                      timingFunction: 'ease',
                      iterationCount: 'infinite'
                    }
                ]);

                $.keyframe.define([{
                name: 'rgb', 
                '80%': {'background-color':col}
                }]);
                }
                //codigo fondo alarma******************


                $(".vart").html(newVal+texrigth);
                $(".alat").html(ala);


                point.update(newVal);
                });
            }, 3000);
        }
    });

      

    }});//ajax peticion PHP

  }//fin funcion tempctrl
    
</script>

