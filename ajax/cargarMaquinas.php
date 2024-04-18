<?php
require('../config/mysql.php');
$m = new Mysql();

$idArea = $_GET['idArea'];

$sql=mysqli_query($m->conexion(), "SELECT * FROM maquina WHERE codigo_area=".$idArea."");

$result = '<label for="exampleInputEmail1">Maquina</label><select name="id_maquina" id="maquina" class="form-control" onChange="charge_equipos(this.value)"><option value="">Seleccionar..</option>';

while ($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
	$result = $result.'<option value="'.$rs['id_maquina'].'">'.$rs['nombre_maquina'].'</option>';
}
	$result = $result.'<select>';
	echo $result;

?>