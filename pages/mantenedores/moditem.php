<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Editar Items </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Editar Item</a>
            </li>
           </ol>
           <?php

               $id = $m->scape($_GET['id']);

                if(isset($_POST['Editar']) == 'Modificar'){
           		
           		  $itemname = $m->scape($_POST['itemname']);
                $status  = $m->scape($_POST['status']);

                // obtener antiguo nombre 
                $find = mysqli_query($m->conexion(), "SELECT * FROM item WHERE id_item='".$id."'");
                $row=mysqli_fetch_array($find,MYSQLI_ASSOC);
                // Guardar antiguo nombre
                $oldname_item = $row['name_item'];
                ///  Preguntar si existe el campo en la tabla plantilla
                $select = mysqli_query($m->conexion(), "SHOW COLUMNS FROM plantilla LIKE '".$oldname_item."'");
                if(mysqli_num_rows($select)){
                  /// si existe modificamos el nombre del anterior campo por el nuevo ingresado
                  $update_name_column_plantilla = mysqli_query($m->conexion(),"ALTER TABLE plantilla CHANGE COLUMN ".$oldname_item." ".$itemname." varchar(20)");
                }             
                /////////////////////////////////////////////////////
                if($update_name_column_plantilla){
                  $update = mysqli_query($m->conexion(), "UPDATE item set name_item='".$itemname."',item_status='".$status."' WHERE id_item='".$id."' LIMIT 1");
                    ?>
					         <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&close;</button>
                    El item se ha actualizo correctamente.
                    </div>
           			<?php
           		}
           }
          if(htmlentities($_GET['action']) == 'down'){
		  	$m->item_status($id,'down');
		  }
		  if(htmlentities($_GET['action']) == 'up'){
		  	$m->item_status($id,'up');
		  }
           if(htmlentities($_GET['action']) == 'edit'){

           		$id = $m->scape($_GET['id']);
           		$find = mysqli_query($m->conexion(), "SELECT * FROM item WHERE id_item='".$id."'");
           		$rs = mysqli_fetch_array($find,MYSQLI_ASSOC);


           	?>
           	<div class="panel panel-default">
              <div class="panel-heading">Modificar Item</div>
              <div class="panel-body">
			<form  method="POST" action="index.php?s=moditem&id=<?php echo $_GET['id']; ?>">
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre del Item</label>
                <input type="text" name="itemname" class="form-control" value="<?php echo $rs['name_item']; ?>" placeholder="Motor,Bomba..." required>
              </div>               
              <div class="form-group">
                <label for="exampleInputPassword1">Estado del Item</label>
                <select name="status" class="form-control">
                    <option value="Habilitado">Habilitado</option>
                    <option value="Desabilitado">Desabilitado</option>
                </select>
              </div>
              <button type="submit" name="Editar" class="btn btn-success">Modificar</button>
            </form>
            </div>
           </div>
           	<?php
           }
           else if(isset($_POST['buscar'])) {
            $nombreItem = $m->scape($_POST['nombre_item']);
            ?>
            <div class="panel panel-default">
              <div class="panel-heading"><form action="" method="POST"><input type="text" name="nombre_item"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></div>
              <div class="panel-body">
                <table class="table">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acción</th>
                  </tr>
                  <?php
                  echo $m->listar_items_nombre($nombreItem);
                  ?>
                </table>
              </div>
            </div> 
            <?php
           }
           else 
           {
           ?>
			     <div class="panel panel-default">
              <div class="panel-heading"><form action="" method="POST"><input type="text" name="nombre_item"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></div>
              <div class="panel-body">
                <table class="table">
                	<tr>
                		<th>#</th>
                		<th>Nombre</th>
                		<th>Estado</th>
                		<th>Acción</th>
                	</tr>
                	<?php
                	echo $m->listar_items();
                	?>
                </table>
              </div>
            </div> 
            <?php } ?>
         </div>
      </div>