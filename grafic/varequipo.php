<script type="text/javascript">
$(document).ready(function () {


// M2304.01 antes

	equipo = 'M-2302.01';

$('select[name="selec"]').click(function(){
    var equipo = this.value;    
    
    if (equipo == 'M-2302.01'){
    $('#varboton').show(); //muestro mediante id
    $('#container').show(); //oculto mediante id
    $('#temctrl').show(); //oculto mediante id
    $('#vibctrl').show(); //oculto mediante id
    $('.barrat').show(); //oculto mediante id
    $('.barrav').show(); //oculto mediante id
    }else{
    $('#varboton').hide(); //oculto mediante id
    $('#container').hide(); //oculto mediante id
    $('#temctrl').hide(); //oculto mediante id
    $('#vibctrl').hide(); //oculto mediante id
    $('.barrat').hide(); //oculto mediante id
    $('.barrav').hide(); //oculto mediante id
    }
 });



});


	$('select[name="selec"]').click();

</script>

<div class="panel-heading">
	<h3 class="panel-title">Graficas Variables</h3>

<div id="varboton">
<!-- <div id="varboton" style="display:none;"> -->
<center>
<button onclick="location.href='index.php?s=realt'" class="btn btn-success btn-xs">realt</button>
<button onclick="location.href='index.php?s=realv'" class="btn btn-success btn-xs">realv</button>
<button onclick="location.href='index.php?s=temctrl'" class="btn btn-success btn-xs">temctrl</button>
<button onclick="location.href='index.php?s=vibctrl'" class="btn btn-success btn-xs">vibctrl</button>
<button onclick="location.href='index.php?s=htemp'" class="btn btn-success btn-xs">htemp</button>
<button onclick="location.href='index.php?s=hvibr'" class="btn btn-success btn-xs">hvibr</button>
</center>
</div>


    
</div>
<div class="panel-body">              
<div class="form-group">
	<label for="">Seleccione Equipo</label>
 

<?php
include("lib/adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("lib/comysql.php");
// config de conexion a db
$mysql->SetFetchMode(ADODB_FETCH_ASSOC);
	echo "<select name='selec'class='breadcrumb'>";
foreach($mysql->Execute('select maquina.nombre_maquina, equipo.nombre_equipo from maquina inner join equipo on equipo.id_maquina=maquina.id_maquina')as $row){ 

 	echo "<option value='".$row['nombre_equipo']."'> ".$row['nombre_equipo']." ".$row['nombre_maquina']."</option>";
}
	echo "</select>";

?>
 </div>        
 </div>






