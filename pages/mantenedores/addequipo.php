<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Equipo </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Equipo</a>
            </li>
	        </ol>
	        <?php
	        if(isset($_POST['Agregar']) == 'Agregar'){

	        	$NombreEquipo = $m->scape($_POST['equipo']);
	        	$id_maquina = $m->scape($_POST['id_maquina']);
	        	$EstadoEquipo = $m->scape($_POST['status']);

	        	echo $id_maquina;

	        	if($m->add_equipo($id_maquina,$NombreEquipo,$EstadoEquipo)){
	        		?>
					<div class="alert alert-dismissible alert-success">
					  <button type="button" class="close" data-dismiss="alert">&close;</button>
					   El equipo <strong> <?php echo $NombreEquipo; ?></strong> ha sido agregado!
					</div>
	        		<?php
	        	}
	        }
	        ?>
	        <div class="panel panel-default">
		  <div class="panel-heading">Agregar Equipo</div>
		  <div class="panel-body">
		   <form  method="POST" action="">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nombre de Equipo</label>
			    <input type="text" name="equipo" class="form-control" id="exampleInputEmail1" placeholder="Motor,Bomba..." required>
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
			  <button type="submit" name="Agregar" class="btn btn-success">Agregar</button>
			</form>
		  </div>
		</div>
	 </div>
</div>