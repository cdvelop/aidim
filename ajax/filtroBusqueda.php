<?php

$db = $_GET['db'];

require('../config/mysql.php');
$m = new Mysql();

if($db == 1) {
	echo '<select class="form-control input-sm" name="area" id="area">';
	echo $m->get_areas();
	echo '</select>';
}
else if ($db == 2){
	echo '<select class="form-control input-sm" name="maquina" id="">';
	echo $m->listar_maquina();
	echo '</select>';
}
else if ($db == 3) {
	echo '<select class="form-control input-sm" name="equipo" id="">';
	echo $m->ListarEquipos();
	echo '</select>';
}
else {
	?>
	<input type="text" name="rut" placeholder="Ingrese Rut" class="form-username form-control input-sm" id="form-username" onblur = "this.value = this.value.replace( /^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')" autofocus>
	<?php
}
?>


	
