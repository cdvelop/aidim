<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Editar Area </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Editar Area</a>
            </li>
           </ol>
           <?php
           
           $areaId = mysqli_real_escape_string($m->conexion(),$_GET['id']);
           $nombreArea = mysqli_real_escape_string($m->conexion(),$_POST['nombre_area']);

          
           if(isset($_POST['Area']) == 'Actualizar') {
           		$name_area = mysqli_real_escape_string($m->conexion(),$_POST['area']);
           		$id_area = mysqli_real_escape_string($m->conexion(),$_POST['idArea']);
           	    if($m->update_area_name($id_area,$name_area)) {
           	    }
           	   ?>
           	   <div class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">X</button>
				  El proceso se completo correctamente!. 
				</div>
           	   <?php
           	   
           }
           ?>
          <div class="panel panel-default">
		  <div class="panel-heading">
		  <h3 class="panel-title"><form action="" method="POST"><input type="text" name="nombre_area"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></h3>
		  </div>
		  <div class="panel-body">
		  <?php
		  if(htmlentities($_GET['action']) == 'down'){
		  	$m->area_status($areaId,'down');
		  }
		  if(htmlentities($_GET['action']) == 'up'){
		  	$m->area_status($areaId,'up');
		  }
		  if(htmlentities($_GET['action']) == 'edit'){
		  		$sql = mysqli_query($m->conexion(),"SELECT * FROM area WHERE id_area='".$areaId."'");
		  		$rs=mysqli_fetch_array($sql,MYSQL_ASSOC);
		  	?>
		  	<form action="index.php?s=modarea" method="POST">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Nombre de Area</label>
			    <input type="text" name="area" class="form-control" value="<?php echo $rs['nombre_area'];?>" placeholder="Area1" required>
			    <input type="hidden" name="idArea" class="form-control" value="<?php echo $rs['id_area'];?>" placeholder="Area1">
			  </div>
			  <input name="Area" type="submit" class="btn btn-success" value="Actualizar">
			</form>
		  <?php
		  }
		  else if(isset($_POST['buscar'])) {
		  		?>
			<div class="table table-responsive">
			<table class="table table-striped">
				<tr>
					<th class="warning">#</th>
					<th class="warning">Nombre de Area</th>
					<th class="warning">Estado</th>
					<th class="danger">Acción</th>
				</tr>
				<?php
				echo $m->list_areas_nombre($nombreArea);
				?>
			</table>
			</div>
           	<?php
		  }
		  else
		  {
		  ?>
		  <div class="table table-responsive">
			<table class="table table-striped">
				<tr>
					<th class="warning">#</th>
					<th class="warning">Nombre de Area</th>
					<th class="warning">Estado</th>
					<th class="danger">Acción</th>
				</tr>
				<?php
				echo $m->list_areas();
				?>
			</table>
			</div>
			<?php } ?>
		  </div>
	    </div>
      </div>
   </div>
</div>