<!-- PAGINACION -->
<?php
// total de registros
$totalUsers = $m->num_rows('users');
//Limito la busqueda
$tamano_pagina = 10;
//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["p"];
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $tamano_pagina;
}
//calculo el total de páginas
$total_paginas = ceil($totalUsers / $tamano_pagina);
?>
<!-- PAGINACION -->
<!-- MODAL -->
<script type="text/javascript">
    function search(id){
       if(id == 2) {
        $("#tipo_operador").load( "tipo_operador.php").show();
       }
       else {
        $("#tipo_operador").hide();
       }
    }
</script>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Datos del Usuario</h4>
            </div>
            <div class="modal-body">
                <?php echo $_GET['id']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- MODAL -->
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            <small>Modificar Usuario </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-dashboard"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"> Modificar Usuario</a>
            </li>
        </ol>
       <?php
        if(isset($_POST['user']) == 'Actualizar'){

        	$rut = $m->scape($_POST['rut']);
        	$nombre = $m->scape($_POST['nombre']);
        	$apellidop = $m->scape($_POST['apellidop']);
        	$apellidom = $m->scape($_POST['apellidom']);
        	$password = $m->scape($_POST['password']);
        	$fecha_nac = $m->scape($_POST['fecha_nac']);
        	$email = $m->scape($_POST['email']);
        	$fono = $m->scape($_POST['fono']);
        	$rol_usuario = $m->scape($_POST['rol_usuario']);
        	$especialidad = $m->scape($_POST['especialidad']);
        	$status = $m->scape($_POST['status']);

        	if($m->user_update($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$fono,$rol_usuario,$especialidad,$status)){
        		?>
        		<div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  El usuario <strong><?php echo $rut; ?></strong> ha sido actualizado correctamente!
				</div>
        		<?php
        	}
        }
       	if(isset($_GET['action']) != false){
       		
       		$action = $_GET['action'];
       		$rut = $_GET['id'];
       	
	       	if($action == 'down'){
	       		if($m->user_modify(0,$rut)){
	       		?>
	       		<div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>Exito!</strong> el cambio se realizo correctamente.
				</div>
	       		<?php
	       		}
	       	}
	       else if($action == 'up'){
	       		if($m->user_modify(1,$rut)){
	       		?>
	       		<div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  <strong>Exito!</strong> el cambio se realizo correctamente.
				</div>
	       		<?php
	       	}
       }

       	}
       ?>
        <div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Gestión de Usuarios</h3>
		  </div>
		  <div class="panel-body">
		  <form action="index.php?s=moduser" method="post" class="form-inline">
			  <div class="form-group">
			    <input type="search" class="form-control" name="searchuser" placeholder="Rut" onChange="this.value = this.value.replace( /^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')">
			  </div>
			  <button type="submit" name="search" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
			  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
			</form>
			<hr>
		   <?php
		   if(isset($_GET['user']) == 'edit'){
		   		$userid = $m->scape($_GET['id']);
		   		$select = mysqli_query($m->conexion() ,"SELECT * FROM users WHERE rut='".$userid."'");
		   		$row=mysqli_fetch_array($select,MYSQLI_ASSOC);
		   	?>
		   	<div class="col-md-12">
		   	<div class="panel panel-success">
			  <div class="panel-heading">
			    <h3 class="panel-title">Editar Usuario</h3>
			  </div>
			  <div class="panel-body">
			  <form action="index.php?s=moduser" method="POST">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Rut</label>
			    <input type="text" class="form-control" name="rut" value="<?php echo $row['rut']; ?>" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Nombre</label>
			    <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']; ?>" required>
			  </div>
			 <div class="form-group">
			    <label for="exampleInputPassword1">Apellido Paterno</label>
			    <input type="text" class="form-control" name="apellidop" value="<?php echo $row['apellido_paterno']; ?>" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Apellido Materno</label>
			    <input type="text" class="form-control" name="apellidom" value="<?php echo $row['apellido_materno']; ?>" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Contraseña</label>
			    <input type="password" class="form-control" name="password" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Fecha de Nacimiento</label>
			    <input type="date" class="form-control" name="fecha_nac" value="<?php echo $row['fecha_nac']; ?>">
			  <div class="form-group">
			    <label for="exampleInputPassword1">Email</label>
			    <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
			  </div>
			  <div class="form-group">
              <label for="exampleInputPassword1">Telefono</label>
              <input type="text" class="form-control" name="fono" value="<?php echo $row['telefono']; ?>">
              </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Rol del Usuario</label>
			    <select name="rol_usuario" class="form-control" onChange="search(this.value)">
			    	<?php
                    echo $m->get_rol(); 
                    ?> 
			    </select>
			  </div>
			    <div class="form-group" id="tipo_operador">
           		</div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Estado del Usuario</label>
			    <select name="status" class="form-control">
			    	<option value="Habilitado">Habilitado</option>
			    	<option value="Desabilitado">Desabilitado</option>
			    </select>
			  </div>
			  <input type="submit" name="user" class="btn btn-success" value="Actualizar">
			</form>	
			  </div>
			</div>
			</div>	  
			<?php
		   }
		   else if(isset($_POST['search']) == 'Buscar'){
		   		$user = $m->scape($_POST['searchuser']);
		   ?>
		   <div class="table table-responsive">
		   <table class="table table-striped">
		   	<tr>
		   		<th>#</th>
		   		<th>Nombre</th>
		   		<th>Contraseña Encryptada</th>
		   		<th>Rol de Usuario</th>
		   		<th>Estado del Usuario</th>
		   		<th>Acción</th>
		   	</tr>
				<?php
				echo $m->search_user($user);
				?>
		    </table>
		    <nav> 
		    </div>
			<?php
		   }
		   else
		   {
		   ?>
		   <div class="table table-responsive">
			<table class="table table-striped">
		   	<tr>
		   		<th class="info">#</th>
		   		<th class="info">Nombre</th>
		   		<th class="info">Contraseña Encryptada</th>
		   		<th class="info">Rol de Usuario</th>
		   		<th class="info">Estado del Usuario</th>
		   		<th class="info">Acción</th>
		   	</tr>
				<?php
				$consulta = mysqli_query($m->conexion(),"SELECT * FROM users LIMIT ".$inicio."," . $tamano_pagina);
				echo $m->list_user($consulta);
				?>
		    </table>
		    <center>
		   	 <ul class="pagination">
		   			<?php if($total_paginas > 1) { 
		   			if ($pagina != 1){
		   			?>
				    <li>
				      <a href="index.php?s=moduser&p=<?php echo $pagina-1?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				    <?php  } 
				    for ($i=1;$i<=$total_paginas;$i++) {
        			 if ($pagina == $i)
        			 	echo $paginas;
        			 else
				    ?>
				    <li><a href="index.php?s=moduser&p=<?php echo $i?>"><?php echo $i;?></a></li>
				    <?php } 
				     if ($pagina != $total_paginas){
				     ?>
				    <li>
				      <a href="index.php?s=moduser&p=<?php echo $pagina+1?>" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				    <?php } ?>
				  </ul>
		    </center>
			<?php
			} 
			?>
		    </div>
		    <?php
			}
		    ?>
		  </div>
		</div>
      </div>
     </div>
  <!-- Page Heading --> 