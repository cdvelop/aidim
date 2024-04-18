<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Modificar Equipo </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Modificar Equipo</a>
            </li>
	        </ol>
	        <?php

			  $EquipoId = mysqli_real_escape_string($m->conexion(),$_GET['id']);

			  if(isset($_POST['Equipo']) == 'Modificar') {
			  	$id_maquina = $m->scape($_POST['id_maquina']);
           		$name_equipo = $m->scape($_POST['equipo']);
           		$equipo_status = $m->scape($_POST['status']);
           	    if($m->update_equipo($EquipoId,$id_maquina,$name_equipo,$equipo_status)) {
           	    }
           	   ?>
           	   <div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  El proceso se completo correctamente!. 
				</div>
           	   <?php
          	   }
			  if(htmlentities($_GET['action']) == 'down'){
			  	$m->equipo_status($EquipoId,'down');
			  }
			  if(htmlentities($_GET['action']) == 'up'){
			  	$m->equipo_status($EquipoId,'up');
			  }
			  if(htmlentities($_GET['action']) == 'edit'){
			  		$sql = mysqli_query($m->conexion(),"SELECT * FROM equipo WHERE id_equipo='".$EquipoId."'");
			  		$rs=mysqli_fetch_array($sql,MYSQL_ASSOC);
		  	?>	

			<div class="panel panel-default">
			  <div class="panel-heading"><form action="" method="POST"><input type="text" name="nombre_item"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></div>
			  <div class="panel-body">
			    <form  method="POST" action="">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Nombre de Equipo</label>
				    <input type="text" name="equipo" value="<?php echo $rs['nombre_equipo']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Motor,Bomba..." required>
				  </div>
				   <div class="form-group">
				    <label for="exampleInputEmail1">Seleccione Maquina</label>
				    <select class="form-control" name="id_maquina">
				    <?php echo $m->listar_maquina(); ?>
				    </select>
				    </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Estado del Equipo</label>
				    <select name="status" class="form-control">
				    	<option value="Habilitado">Habilitado</option>
				    	<option value="Desabilitado">Desabilitado</option>
				    </select>
				  </div>
				  <button type="submit" name="Equipo" class="btn btn-success">Modificar</button>
				</form>
			  </div>
			</div>		  	
		  	<?php } else if(isset($_POST['buscar'])) {
		  	?>
			<div class="panel panel-default">
			  <div class="panel-heading"><form action="" method="POST"><input type="text" name="nombre_item"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></div>
			  <div class="panel-body">
			    <table class="table">
	        	<tr>
	        		<th>#</th>
	        		<th>Nombre Equipo</th>
	        		<th>Estado</th>
	        		<th>Acción</th>
	        	</tr>
	        	<?php
	        	echo $m->listar_equipos_nombre($_POST['nombre_item']);
	        	?>
	        	</table>
			  </div>
			</div>
		  	<?php
		  	}
		  	else { ?>
		  	<div class="panel panel-default">
			  <div class="panel-heading"><form action="" method="POST"><input type="text" name="nombre_item"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></div>
			  <div class="panel-body">
			    <table class="table">
	        	<tr>
	        		<th>#</th>
	        		<th>Nombre Equipo</th>
	        		<th>Estado</th>
	        		<th>Acción</th>
	        	</tr>
	        	<?php
	        	echo $m->listar_equipos();
	        	?>
	        	</table>
			  </div>
			</div>
	        <?php } ?>
		</div>
	</div>
