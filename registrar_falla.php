<?php
session_start();

error_reporting(0);

ini_set('date.timezone', 'America/Santiago');

$fecha = $fecha.date('Y-m-d');
$fecha = $fecha.' '.date('H:i:s', time() - date('Z'));

require('config/mysql.php');

$class = new Mysql();

$equipo = mysqli_real_escape_string($class->conexion(),$_GET['equipo']);
$tipo_falla = mysqli_real_escape_string($class->conexion(),$_GET['tipo_falla']);
$falla_1 = mysqli_real_escape_string($class->conexion(),$_GET['falla1']);
$falla_2 = mysqli_real_escape_string($class->conexion(),$_GET['falla2']);
$id_inspeccion = mysqli_real_escape_string($class->conexion(),$_GET['id_inspeccion']);

sleep(1);

$sql = mysqli_query($class->conexion(), "INSERT INTO falla (codigo_falla,id_equipo,id_operador,id_inspeccion,tipo_falla,falla_1,falla_2,fecha_falla) VALUES (null,".$equipo.",'".$_SESSION['rut']."',".$id_inspeccion.",".$tipo_falla.",'".$falla_1."','".$falla_2."','".$fecha."')");

if($sql){
	echo '1';
}
else {
	echo '0';
}
?>