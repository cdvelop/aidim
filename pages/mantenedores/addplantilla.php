<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Plantilla</small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Plantilla</a>
            </li>
	        </ol>
            <?php
            if(isset($_POST['Action']) =='Crear Plantilla'){
                  
                $id_equipo = $m->scape($_POST['nameequipo']);

                // GUARDAR DATOS DE FORMULARIO EN UN ARRAY
                    $datos[] = array();
                    $i=0;
                    foreach ($m->total_colum_array() as $key => $value) {

                      if($i > 1){
                       $datos[] = $_POST[$value];
                      }
                      $i++;
                    }   
                /// ------------------------------------- //
                // INSERTAR VALORES EN PLANTILLA DESDE EL ARRAY 
                    foreach ($datos as $key => $value) {
                       if($key != 0) {
                          if($value ==  false) {
                             $result = $result.'"D",';
                          }
                          else {
                             $result = $result.'"H",';
                          }                              
                        }
                      }
					         
                   $plantilla_status = $m->scape($_POST['status']);
                   
                   $result = substr($result, 0, -1);
                   
                   if($m->add_plantilla($result,$id_equipo,$plantilla_status)) {
                   ?>
                   <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                       La plantilla ha sido creada para el equipo <strong><?php echo $m->get_name_equipo($id_equipo); ?></strong>
                   </div>
                   <?php
                   } 
                   else
                   {
                    ?>
                    <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                       El equipo <strong><?php echo $m->get_name_equipo($id_equipo); ?> Ya posse una plantilla</strong>
                   </div>
                    <?php
                   }
		         /// ------------------------------------- //                
               }
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Agregar Plantilla</h3>
              </div>
              <div class="panel-body">
                 <form action="" method="POST">
                  <div class="form-group">
                  <label for="">Seleccione Equipo</label>
                   <select name="nameequipo" class="form-control">
                    <?php echo $m->ListarEquipos(); ?>
                   </select>
                  </div>
                  <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Seleccione los item a checkear para el equipo</h3>
                  </div>
                  <div class="panel-body">
                  <?php echo $m->ListarItems(); ?>
                  </div>
                  </div>  
                  <div class="form-group">
                  <label for="exampleInputPassword1">Estado de la Plantilla</label>
                  <select name="status" class="form-control">
                    <option value="Habilitado">Habilitado</option>
                    <option value="Desabilitado">Desabilitado</option>
                  </select>
                </div>              
                  <hr>
                  <button type="submit" name="Action" class="btn btn-success">Crear Plantilla</button>
                  <button type="reset" class="btn btn-warning"> Resetear</button>
                </form>
              </div>
            </div>   
        </div>
    </div>