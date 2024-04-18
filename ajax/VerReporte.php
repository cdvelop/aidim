<?php

$id_inspeccion = $_GET['id_inspeccion'];

sleep(1);

require('../config/mysql.php');
$m = new Mysql();
$sql = mysqli_query($m->conexion(), "SELECT * FROM plantilla_revision WHERE id_inspeccion='".$id_inspeccion."'");
?>


<?php
while ($rows=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
	
}

?>
