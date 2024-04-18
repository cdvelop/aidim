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
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Inspecciones Actuales</small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Inspecciones Actuales</a>
            </li>
	        </ol>
            <?php

            $id = $m->scape(@$_GET['id']);

             if(htmlentities(@$_GET['action']) == 'down'){
                $m->inspeccion_status($id,'down');
              }
              if(htmlentities(@$_GET['action']) == 'up'){
                $m->inspeccion_status($id,'up');
              }

             $sql = mysqli_query($m->conexion(),"SELECT * FROM inspeccion WHERE id_inspeccion='".$id."' LIMIT 1");
             $rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);

             if(htmlentities(@$_GET['action']) == 'edit'){

                if(isset($_POST['Crear']) == 'Crear Inspeccion'){

                    $area = $m->scape($_POST['area']);
                    $maquina = $m->scape($_POST['maquina']);
                    $equipo = $m->scape($_POST['equipo']);
                    $operador = $m->scape($_POST['operador']);
                    $fecha_inicio = $m->scape($_POST['fecha_inicio']);
                    $fecha_termino = $m->scape($_POST['fecha_termino']);
                    $status = $m->scape($_POST['status']);


                    if($m->update_inspeccion($id,$area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino,$status)){
                       ?>
                        <div class="alert alert-dismissible alert-success">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                         La inspeccion se ha actualizado correctamente.
                        </div>
                       <?php
                    }

                }
                
             ?>
             <div class="panel panel-default">
              <div class="panel-heading">Actualizar Inspección</div>
              <div class="panel-body">
                <form action="" method="POST"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Area</label>
                  <select name="area" class="form-control alert-success">
                    <option value="<?php echo $rs['id_area']; ?>"><?php echo $m->get_name_area($rs['id_area']); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Maquina</label>
                  <select name="maquina" class="form-control alert-warning">
                    <option value="<?php echo $rs['id_maquina']; ?>"><?php echo $m->get_name_maquina($rs['id_maquina']); ?></option>
                  </select>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Equipo</label>
                  <select name="maquina" class="form-control alert-info">
                    <option value="<?php echo $rs['id_equipo']; ?>"><?php echo $m->get_name_equipo($rs['id_equipo']); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Operador</label>
                  <select name="operador" class="form-control alert-danger">
                    <option value="<?php echo $rs['id_operador']; ?>"><?php echo $m->get_name_operadores($rs['id_operador']); ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha de Inicio</label>
                  <input id="fecha_inicio" name="fecha_inicio" value="<?php echo $rs['fecha_inicio']; ?>" class="form-control" type="text" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha de Termino</label>
                 <input id="fecha_termino" name="fecha_termino" value="<?php echo $rs['fecha_termino']; ?>" class="form-control" type="text" >
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Estado del Equipo</label>
                <select name="status" class="form-control">
                  <option value="Habilitado">Habilitado</option>
                  <option value="Desabilitado">Desabilitado</option>
                </select>
              </div>
                <button type="submit" name="Crear" class="btn btn-success">Actualizar Inspeccion</button>
              </form>
              </div>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">Lista de Inspecciones</div>
              <div class="panel-body">
             <table class="table">
                 <tr>
                     <th class="info">Area</th>
                     <th class="info">Maquina</th>
                     <th class="info">Equipo</th>
                     <th class="info">Operador</th>
                     <th class="info">Fecha de Inicio</th>
                     <th class="info">Fecha de Termino</th>
                     <th class="info">Estado (Hab/Des)</th>
                     <th class="info">Estado General</th>
                     <th class="info">Acción</th>
                 </tr>
                 <?php echo $m->Listar_Inspecciones(); ?>
             </table>   
          </div>        
        </div>
        <?php } ?>
          <script type="text/javascript">
          $(function () {
                  $('[data-toggle="popover"]').popover()
                });
          </script>
           <script type="text/javascript">
              function charge_equipos(id) {
                $('#Listarequipos').load('pages/mantenedores/listar_equipos.php?id_maquina='+id);
              }
              $('#fecha_inicio').datetimepicker();
              $('#fecha_termino').datetimepicker();
              </script>
    </div>
 </div>