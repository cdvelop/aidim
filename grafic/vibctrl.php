

<?php
switch ($_GET['mostrar']) {
    
    case 1:
    echo "<script type='text/javascript'>var equipo = 'M-2302.01';</script>";
    echo "<script type='text/javascript'>

    var ruta = 'lib/';
    
    var alarmaOnOff = 0;

    var texrigth = '';

    vibctrl(ruta,alarmaOnOff);";

        break;
    
    default:

    include("varequipo.php");
    echo '<link href="grafic/lib/css/ctrol.css" rel="stylesheet">';

    echo '<div id="vibctrl" style="min-width: 360px; max-width: 450px; height: 350px; margin: 0 auto"></div>';
    echo '<center>';
    echo '<div class="barrav">';
    echo '<div class="varv">mm/s<sup>2</sup></div>';
    echo '<div class="alav">estado de equipo</div>';
    echo '</div>';
    echo '</center>';

    echo "<script type='text/javascript'>

    var ruta = 'grafic/lib/';
    var seg = '20s';
    var col ='#BEDEB6';//verde
    var alarmaOnOff = 1;
    
    var texrigth = ' mm/s<sup>2</sup>';

    vibctrl(ruta);";
    
        break;
}

?>


    function vibctrl(ruta){

            Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $.ajax({
                url: ruta+"dtos.vibctrl.php",
                type: 'get',
                success: function(Dato) {


    $('#vibctrl').highcharts({
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
            useHTML: true,
            text: 'Vibracion '+equipo+' mm/s<sup>2</sup>'
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
                backgroundColor: 'rgba(20, 123, 238, 0.3)',
                borderWidth: 0,
                outerRadius: '109%'
            }, 
                // default background
            {
                backgroundColor: 'rgba(0, 0, 0, 20)',
                borderWidth: 3,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
// #147BEE
        // the value axis
        yAxis: {
            min: 0,
            max: 20,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#0966F1',

            tickPixelInterval: 50,
            tickWidth: 1,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#0966F1',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                useHTML: true,
                text: 'mm/s<sup>2</sup>'
            },
            plotBands: [{
                from: 0,
                to: 5,
                color: '#55BF3B' // green
            }, {
                from: 5,
                to: 8,
                color: '#DDDF0D' // yellow
            }, {
                from: 8,
                to: 20,
                color: '#DF5353' // red
            }]
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Vibracion',
            data: Dato,
            tooltip: {
                useHTML: true,
                valueSuffix: ' mm/s<sup>2</sup>'
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
                $.get( ruta+"dtos.vibctrl.php?Consultar=1", function( UltimosDatos ) {
                var point = chart.series[0].points[0],
                    newVal,                

                inc = UltimosDatos - point.y; 
                

                newVal = point.y + inc;
                if (newVal < 0 || newVal > 20) {
                    newVal = point.y - inc;
                }
            
                
                var f = Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', (new Date()).getTime());
                chart.setTitle(null, { text: f});   

                
                //codigo fondo alarma******************
                var ala = "estado vibracion de equipo: normal";

                if (newVal>5){
                if(alarmaOnOff==1){
                seg = "5s";
                col ='#DDDF0D';}//amarillo
                ala = "alarma vibracion: llamar control sintomatico";  
                }

                if (newVal>8){
                if(alarmaOnOff==1){
                seg = "2s";
                col ='#DF5353';}//rojo
                ala = "alarma vibracion : detener equipo";   
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

                $(".varv").html(newVal+texrigth);
                $(".alav").html(ala);


                point.update(newVal);
                });
            }, 3000);
        }
    });

      

    }});//ajax peticion PHP

       }//fin funcion vibtrl

</script>