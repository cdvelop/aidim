<?php
$id_plantilla = $m->scape($_GET['id']);
?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Modifcar Plantilla</small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Modificar Plantilla</a>
            </li>
           </ol>
           <?php
            if(isset($_POST['action']) == 'Actualizar'){

                $id = $m->scape($_GET['id']);
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
                   if($m->update_plantilla($result,$id_equipo,$plantilla_status,$id)) {
                   ?>
                   <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                       La plantilla ha sido actualizada correctamente..
                   </div>
                   <?php
                   } 
                /// ------------------------------------- //                
               }
            ?>
           <?php
            $id = $m->scape($_GET['id']);

            $table = "plantilla";
            $columna = 'plantilla_status';

            if(htmlentities($_GET['action']) == 'down'){
            $status = 'down';
            $m->set_status_plantilla($table,$status,$columna,$id);
              }
            if(htmlentities($_GET['action']) == 'up'){
                $status = 'up';
                $m->set_status_plantilla($table,$status,$columna,$id);
            }
            if(htmlentities($_GET['action']) == 'edit') {
              $id = $m->scape($_GET['id']);
              $find = mysqli_query($m->conexion(),"SELECT id_equipo FROM plantilla WHERE id_plantilla='".$id."'");
              $row = mysqli_fetch_array($find,MYSQLI_ASSOC);
              $find = mysqli_query($m->conexion(),"SELECT nombre_equipo FROM equipo WHERE id_equipo='".$row['id_equipo']."'");
              $rows = mysqli_fetch_array($find,MYSQLI_ASSOC);
            ?>
            <div class="panel panel-default">
            <div class="panel-heading">Panel heading</div>
            <div class="panel-body">
              <form action="" method="POST">
                  <div class="form-group">
                  <label for="">Seleccione Equipo</label>
                   <select name="nameequipo" class="form-control">
                    <option value="<?php echo $row['id_equipo']; ?>"><?php echo $rows['nombre_equipo']; ?></option>
                   </select>
                  </div>
                  <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Seleccione los item a checkear para el equipo</h3>
                  </div>
                  <div class="panel-body">
                  <?php echo $m->ListarItems_edit($id_plantilla); ?>
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
                  <button type="submit" name="action" class="btn btn-success">Actualizar</button>
                  <button type="reset" class="btn btn-warning"> Resetear</button>
                </form>
             </div>
            </div>
             <?php
             }
             else if(isset($_POST['buscar'])) {
              $NombreDeEquipo = $m->scape($_POST['nombre_equipo'])
              ?>
              <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><form action="" method="POST"><input type="text" name="nombre_equipo"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></h3>
              </div>
              <div class="panel-body">
              <table class="table">
              <tr>
              <td>#</td>
              <td>Nombre de Equipo</td>
              <td>Estado</td>
              <td>Acción</td>
              </tr>             
              <?php 
              echo $m->ListarPlantillas_equipo($NombreDeEquipo);                  
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
              <div class="panel-heading">
                <h3 class="panel-title"><form action="" method="POST"><input type="text" name="nombre_equipo"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></h3>
              </div>
              <div class="panel-body">
              <table class="table">
              <tr>
              <td>#</td>
              <td>Nombre de Equipo</td>
              <td>Estado</td>
              <td>Acción</td>
              </tr>             
              <?php 
              echo $m->ListarPlantillas();              		
              ?>             
              </table>
              </div>
            </div>  
            <?php } ?> 
        </div>
     </div>