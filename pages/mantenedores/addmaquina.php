<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Maquina </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Maquina</a>
            </li>
	        </ol>
	        <?php
	        if(isset($_POST['Action']) == 'Agregar'){

	        	$NombreMaquina = $m->scape($_POST['nmaquina']);
	        	$IdArea = $m->scape($_POST['idArea']);

	        	if($m->add_maquina($NombreMaquina,$IdArea)){
	        		?>
	        		<div class="alert alert-dismissible alert-success">
					  <button type="button" class="close" data-dismiss="alert">X</button>
					 La maquina <strong><?php echo $NombreMaquina; ?></strong> se ha añadido correctamente.
					</div>
	        		<?php
	        	}

	        }
	        ?>
	        <div class="panel panel-success">
			  <div class="panel-heading">
			    <h3 class="panel-title">Agregar Maquina</h3>
			  </div>
			  <div class="panel-body">
			     <form action="" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Nombre de Maquina</label>
				    <input type="text" name="nmaquina" class="form-control" placeholder="Nombre de Maquina" required>
				  </div>
				   <div class="form-group">
				    <label for="exampleInputEmail1">Area de Maquina</label>
				    <select name="idArea" id="idArea" class="form-control">
				    <?php
				    echo $m->get_areas();
				    ?>
				    </select>
				  </div>
				  <button type="submit" name="Action" class="btn btn-success">Agregar</button>
				</form>
			  </div>
			</div>       
         </div>
     </div>