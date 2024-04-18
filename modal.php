<?php session_start(); ?>
<script type="text/javascript">
	$('#closemodal').click(function() {
    $('#myModal').css('display','none');
    location.reload(); 
});

$('#myModal').on('hidden.bs.modal', function (e) {
    location.reload(); 
})
</script>
<?php
if(isset($_SESSION['rut'])) {
	require('clases/funciones.php');
	$m = new Mantenedores();
	$rut= mysqli_real_escape_string($m->conexion(),$_GET['id']);
	$sql = mysqli_query($m->conexion(),"SELECT * FROM users WHERE rut='".$rut."'");
	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
?>
<div class="panel panel-default">
  <div class="panel-heading">Datos del Usuario   <button type="button" class="close" id="closemodal" data-dismiss="alert">X</button> </div>
  <div class="panel-body">
	<table class="table table-bordered">
		<tr>
			<th class="warning">Rut</th>
			<td><?php echo $row['rut']; ?></td>
		</tr>
		<tr>
			<th class="warning">Nombre</th>
			<td><?php echo $row['nombre']; ?></td>
		</tr>
		<tr>
			<th class="warning">Apellido Paterno</th>
			<td><?php echo $row['apellido_paterno']; ?></td>
		</tr>
		<tr>
			<th class="warning">Apellido Paterno</th>
			<td><?php echo $row['apellido_materno']; ?></td>
		</tr>
		<tr>
			<th class="warning">Fecha de Nacimiento</th>
			<td><?php echo $row['fecha_nac']; ?></td>
		</tr>
		<tr>
			<th class="warning">Email</th>
			<td><?php echo $row['email']; ?></td>
		</tr>
		<tr>
		   <th class="warning">Telefono</th>
		   <td><?php echo $row['telefono']; ?></td>
		  </tr>
		<tr>
			<th class="warning">Contraseña</th>
			<td>*************</td>
		</tr>
		<tr>
			<th class="warning">Rol</th>
			<td><?php echo $m->get_name_rol($row['rol_usuario']); ?></td>
		</tr>
		<tr>
			<th class="warning">Status</th>
			<td><?php echo $m->status_name($row['status']); ?></td>
		</tr>

	</table>
  </div>
</div>
<?php } ?>