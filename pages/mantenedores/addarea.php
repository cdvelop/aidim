<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Area </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Area</a>
            </li>
           </ol> 
           <?php
           if(isset($_POST['Action']) == 'Agregar'){
           		$NombreArea = $m->scape($_POST['area']);
           		if($m->add_area($NombreArea)){
           		}
           		?>
           		<div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">&close;</button>
				 El area  <strong><?php echo $NombreArea; ?></strong> se ha añadido correctamente.
				</div>
           <?php
           }
           ?>
          <div class="panel panel-default">
		  <div class="panel-heading">
		  <h3 class="panel-title">Gestión de Areas</h3>
		  </div>
		  <div class="panel-body">
			<form action="" method="POST">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nombre de Area</label>
			    <input type="text" name="area" class="form-control" placeholder="Area1" required>
			  </div>
			  <button type="submit" name="Action" class="btn btn-success">Agregar</button>
			</form>
		  </div>
	    </div>
      </div>
   </div>
</div>