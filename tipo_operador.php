<?php
session_start();
require('clases/funciones.php');
if(!$_SESSION['rut']){
    header('Location: login.php');
    exit();
}
else {
	$m = new Mantenedores();
	echo '<label>Tipo de Operador</label>'.$m->listar_especialidad();
}
?>