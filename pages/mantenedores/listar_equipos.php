<?php
require('../../config/mysql.php');
	$class = new Mysql();
	$id_maquina = mysqli_real_escape_string($class->conexion(), $_GET['id_maquina']);
	$listar = mysqli_query($class->conexion(), "SELECT * FROM equipo WHERE id_maquina=".$id_maquina."");
	while ($rs=mysqli_fetch_array($listar,MYSQL_ASSOC)) {
	$result = $result.'<option value="'.$rs['id_equipo'].'">'.$rs['nombre_equipo'].'</option>';
	}
?>
<div class="form-group">
<label for="exampleInputEmail1">Equipo</label>
<select name="equipo" class="form-control alert-info">
<?php echo $result; ?>
</select>
</div>