
<script type="text/javascript">
$(document).ready(function () {

	maquina = 'Calibradora';

$('select[name="selec"]').click(function(){
    var maquina = this.value;    
    
    if (maquina == 'Calibradora'){
    $('#varboton').show(); //muestro mediante id
    $('#container').show(); //oculto mediante id
    $('.barra').show(); //oculto mediante id
    $('#oeekpi').show(); //oculto mediante id
    }else{
    $('#varboton').hide(); //oculto mediante id
    $('#container').hide(); //oculto mediante id
    $('.barra').hide(); //oculto mediante id
    $('#oeekpi').hide(); //oculto mediante id
    }
 });


});
$('select[name="selec"]').click();

</script>

<div class="panel-heading">
	<h3 class="panel-title">Grafica KPI</h3>
<div id="varboton">
<center>

<button onclick="location.href='index.php?s=oee'" class="btn btn-success btn-xs"> OEE </button>
<button onclick="location.href='index.php?s=hoee'" class="btn btn-success btn-xs"> HOEE </button>
<button onclick="location.href='index.php?s=hdis'" class="btn btn-success btn-xs"> hdis </button>
<button onclick="location.href='index.php?s=hrit'" class="btn btn-success btn-xs"> hrit </button>
<button onclick="location.href='index.php?s=hcal'" class="btn btn-success btn-xs"> hcal </button>
</center>
</div>   
</div>
<div class="panel-body">              
<div class="form-group">
	<label for="">Seleccione Maquina</label>
 

<?php
include("lib/adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("lib/comysql.php");
// config de conexion a db
$mysql->SetFetchMode(ADODB_FETCH_ASSOC);
	echo "<select name='selec'class='breadcrumb'>";
foreach($mysql->Execute('SELECT nombre_maquina FROM maquina ORDER BY nombre_maquina ASC')as $row){ 

 	echo "<option value='".$row['nombre_maquina']."'> ".$row['nombre_maquina']."</option>";
}
	echo "</select>";

?>
 </div>        
 </div>




