<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Modificar Maquina </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Modificar Maquina</a>
            </li>
           </ol> 
           <?php

           $id = $m->scape($_GET['id']);
           $datos = mysqli_query($m->conexion(), "SELECT * FROM maquina");
           $rows = mysqli_fetch_array($datos,MYSQLI_ASSOC);
           $table = "maquina";
           $columna = 'id_maquina';
            if(htmlentities($_GET['action']) == 'down'){
            $status = 'down';
            $m->set_status($table,$status,$columna,$id);
              }
            if(htmlentities($_GET['action']) == 'up'){
                $status = 'up';
                $m->set_status($table,$status,$columna,$id);
             }
            if(isset($_POST['Modificar']) == 'Modificar') {

                    $NombreMaquina = $m->scape($_POST['nmaquina']);
                    $idarea = $m->scape($_POST['idArea']);
                    $id_maquina = $m->scape($_POST['id_maquina']);

                if($m->update_maquina($idarea,$id_maquina,$NombreMaquina)){
                    ?>
                    <div class="alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      La actualizacion se completo correctamente!. 
                    </div>
                    <?php
                }
            }
            if(htmlentities($_GET['action']) == 'edit'){ 
            ?>
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Modificar Maquina</h3>
              </div>
              <div class="panel-body">
                 <form action="index.php?s=modmaquina" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de Maquina</label>
                    <input type="text" name="nmaquina" class="form-control" placeholder="Nombre de Maquina" value="<?php echo $rows['nombre_maquina']; ?>" required>
                    <input type="hidden" name="id_maquina" class="form-control" placeholder="Nombre de Maquina" value="<?php echo $rows['id_maquina']; ?>">
                     </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Area de Maquina</label>
                    <select name="idArea" id="idArea" class="form-control">
                    <?php
                    echo $m->get_areas();
                    ?>
                    </select>
                  </div>
                  <button type="submit" name="Modificar" class="btn btn-success">Modificar</button>
                </form>
              </div>
            </div>  
            <?php
            }
            else if(isset($_POST['buscar'])) {
              $NombreDeMaquina = $m->scape($_POST['nombre_maquina']);
              ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                <h3 class="panel-title"><form action="" method="POST"><input type="text" name="nombre_maquina"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></h3>
                </div>
                <div class="panel-body">
                 <table class="table table-striped">
                 <tr>
                 <th>#</th>
                 <th>Area</th>
                 <th>Nombre de Maquina</th>
                 <th>Estado</th>
                 <th>Acción</th>
                 </tr>
                 <?php
                 echo $m->get_maquinas_nombre($NombreDeMaquina);
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
              <h3 class="panel-title"><form action="" method="POST"><input type="text" name="nombre_maquina"> <button type="submit" name="buscar" class="btn btn-success btn-xs"> Buscar</button></form></h3>
              </div>
              <div class="panel-body">
               <table class="table table-striped">
               <tr>
               <th>#</th>
               <th>Area</th>
               <th>Nombre de Maquina</th>
               <th>Estado</th>
               <th>Acción</th>
               </tr>
               <?php
               echo $m->get_maquinas();
               ?>
           </table>
          </div>
        </div>
    <?php } ?>
    </div>
</div>