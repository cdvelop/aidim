<!DOCTYPE HTML>
<html>
	<head>
     <meta http-equiv="X-UA-Compatible" content="IE=9;IE=10;IE=Edge,chrome=1"/>
    <link rel="shortcut icon" href="http://localhost/tesis/grafic/lib/temvibctrlsystem.ico"> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>medidor</title>
		<script type="text/javascript" src="lib/Highcharts/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="lib/Highcharts/jquery.keyframes.min.js"></script>

        <!-- CSS -->
        <link href="lib/css/ctrol.css" rel="stylesheet">

        <!-- comandos para el control de respaldo de db sql diaria  a aidim db-->
        <script type="text/javascript" src="lib/ctrl.backup.js"></script>


<script type="text/javascript">
// $(window).keydown(function (e){
//     if (e.ctrlKey) alert("control");
// });


$(document).ready(function () {


 window.location.assign("appurl:1");




        requestemp();
        requesvib();
        
        function requestemp() {
            $.ajax({
                url: 'temctrl.php?mostrar=1',
                success: function(temctrl) {
                  $('#temctrl').html(temctrl);   
                }
                // cache: false
            });
        }

        function requesvib() {
            $.ajax({
                url: 'vibctrl.php?mostrar=1',
                success: function(temctrl) {
                  $('#vibctrl').html(temctrl);   
                },
                cache: false
            });
        }




          
            
        


   alarma();
    // Add some life
    function alarma() {
          setInterval(function () {

            var tem = $("#vart").text();
            // $(".tem").text(tem);

            var vib = $("#varv").text();
            // $(".vib").text(vib);


                if (tem<60 | vib<5 ){
                seg = '20s';
                col ='#BEDEB6';//verde



                }

                if (tem>60 | vib>5 ){
                seg = '5s';
                col ='#DDDF0D';//amarillo

               
                }

                if (tem>80 | vib>8){
                seg = '2s';
                col ='#DF5353';//rojo


                


                }

                // cambiar propiedades de color fondo
                $('#puerco').playKeyframe([
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
                //codigo fondo alarma******

             // $(".vib").text(seg);

                

                }, 3000);
            }



});


</script>
	</head>
	<body id="puerco">

<script src="lib/highcharts/highcharts.js"></script>
<script src="lib/highcharts/highcharts-more.js"></script>
<script src="lib/highcharts/exporting.js"></script>



<TABLE BORDER=1 WIDTH=100%>
<TR>
<TD WIDTH=50% height=500px id="tem">
<div id="temctrl" style="min-width: 450px; max-width: 450px; height: 400px; margin: 0 auto"></div>

</TD>

<TD WIDTH=50% id="vib">
<div id="vibctrl" style="min-width: 450px; max-width: 450px; height: 400px; margin: 0 auto"></div>

</TD>
</TR>

<TR>
<TD WIDTH=50%>

<div class="barractrlt"><div id="tt">Cº</div>
<div id="vart" class="vart" style="text-align: right; width: 50%;">Cº</div>
<div class="alat">estado temperatura</div>
</div>
</TD>

<TD WIDTH=50%>
<div class="barractrlv"><div id="tv"> mm/s<sup>2</sup></div>
<div id="varv" class="varv" style="text-align: right; width: 50%;">mm/s<sup>2</sup></div>
<div class="alav">estado vibracion</div>
</div>
</TD>
</TR>

</TABLE>

<!-- <div id="hoyser">hoyser</div> -->
<!-- <div id="hoyaidim">hoyaidim</div> -->
<!-- <div class="tem">tem</div> -->
<!-- <br> -->
<!-- <div class="vib">vib</div> -->

<a href='webrun:"C:\AppServ\www\tesis\grafic\lib\sms>entel.exe +2323323 tessssss'>sms</a>

   <a href='webrun:cmd /k &cd C:\AppServ\www\tesis\grafic\lib\sms& au3 entel.au3 2323 "hahhhsh"'>List contents of C:\</a>

	</body>
</html>
