<!-- Modal -->
<script type="text/javascript">
  
$(document).ready(function() {
  $("#registrarFallas").click(function() {
      $("#registrarFalla").toggle('slow');
      $("#registrarFalla").focus();
  });
  
  $('#registrar').click(function(){


      var Equipo = $('#equipo').val();
      var Tipo_Falla = $('#tipo_falla').val();
      var IdInspeccion = $('#id_inspeccion').val();
      var Falla1 = $('#falla1').val();
      var Falla2 = $('#falla2').val();

      var dataString = 'equipo='+Equipo+'&id_inspeccion='+IdInspeccion+'&tipo_falla='+Tipo_Falla+'&falla1='+Falla1+'&falla2='+Falla2;

       $.ajax({
        type:"GET",
        url: "registrar_falla.php",
        data: dataString,
        beforeSend: function(){
        $("#msg").html('<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">X</button><p>Espere Porfavor... <img src="img/ajax-loader.gif"></p></div>');
        },
        success: function(data){
          if(data == '1') {
            $("#msg").html('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">X</button>La falla se ha registrado satisfactoriamente.</div>');
             $("#registrarFalla").toggle('slow');
            }
            else {
              $("#msg").html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">X</button>Solo puedes añadir una falla por cada inspección!.</div>');
            }
          }
     });
   });
});
</script>
<?php if($m->get_rol_id($_SESSION['rol_usuario']) == 'Administrador') { ?>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Bienvenido <?php echo $_SESSION['nombre']; ?> (<?php echo $m->get_rol_id($_SESSION['rol_usuario']); ?>) </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"></a>
            </li>
           </ol> 
            <div class="panel panel-default">
              <div class="panel-heading"></div>
              <div class="panel-body">
              <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">6</div>
                                    <div>Usuarios!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>                    
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">4</div>
                                    <div>Inspecciones!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>                    
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10</div>
                                    <div>Equipos!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>                    
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">8</div>
                                    <div>Areas!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>                    
                </div>
              </div>
            </div>
          </div>
        </div>
   <?php } else if($m->get_rol_id($_SESSION['rol_usuario']) == 'Operador') { ?>
  <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Bienvenido <strong><?php echo $_SESSION['nombre']; ?> (<?php echo $m->get_rol_id($_SESSION['rol_usuario']); ?>)</strong></small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"> Inspecciones</a>
            </li>
           </ol> 
           <?php 
           if(isset($_POST['submit']) == 'Finalizar'){

                 $id_plantilla = $m->scape($_GET['id_plantilla']);
                 $id_equipo = $m->scape($_GET['id_equipo']);
                 $id_inspeccion = $m->scape($_GET['id_inspeccion']);


                $sql = mysqli_query($m->conexion() ,"SELECT * FROM plantilla WHERE id_plantilla='".$id_plantilla."'");
                $rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);

                    foreach($_POST as $nombre_campo => $valor){
                        $result = $result.$nombre_campo.',';
                            $result2 = $result2.'"'.$valor.'",';
                    } 

                    $string =  substr($result, 0, -8);
                    $string2 =  substr($result2, 0, -4);

                    $insert = mysqli_query($m->conexion(), "INSERT INTO plantilla_revision (id_inspeccion,id_equipo,".$string.") VALUES ('".$id_inspeccion."','".$id_equipo."',".$string2.")");
                    if($insert){
                        $update = mysqli_query($m->conexion(), "UPDATE inspeccion SET status_general='Realizada' WHERE id_equipo='".$id_equipo."' and id_operador='".$_SESSION['rut']."' and id_inspeccion='".$id_inspeccion."' LIMIT 1");
                        if($update){
                            ?>
                            <div class="alert alert-dismissible alert-success">
                              <button type="button" class="close" data-dismiss="alert">X</button>
                              Inspeccion <strong>Terminada!</strong> 
                            </div>
                            <?php
                        }
                    }
                    exit();
                }
            ?>
            <div class="panel panel-default">
            <div class="panel-heading">
            </div>
              <div class="panel-body">
              <?php 
                $id_plantilla = $m->scape($_GET['id_plantilla']);
                $id_inspeccion = $m->scape($_GET['id_inspeccion']);
                $fecha_actual = strtotime(date("Y-m-d H:i:s"));
                if(htmlentities($_GET['action']) == 'check'){

                    ///////////////////////////////
                 
                     $buscar_fecha = mysqli_query($m->conexion(), "SELECT * FROM inspeccion WHERE id_inspeccion=".$id_inspeccion." AND status_general = 'No realizada'");

                     $rs=mysqli_fetch_array($buscar_fecha,MYSQLI_ASSOC);

                     $fecha_inicio =strtotime($rs['fecha_inicio']);
                     $fecha_termino = strtotime($rs['fecha_termino']);

                     

                     
                     if($fecha_inicio > $fecha_actual) {
                      echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">X</button>  <strong>Stop!</strong> Aun no puedes empezar la inspeccion por que la hora de inicio no esta cumplida!<a href="javascript:history.back();" class="alert-link"> Volver</div>';                   
                       exit();
                     }

                     if($fecha_actual >= $fecha_termino) {

                      echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">X</button>  <strong>Stop!</strong> No puedes hacer la inspeccion por que la hora de termino ha caducado!<a href="javascript:history.back();" class="alert-link"> Volver</div>';                   
                       exit();
                     }

                    ///////////////////////////////

                    $sql = mysqli_query($m->conexion() ,"SELECT * FROM plantilla WHERE id_plantilla='".$id_plantilla."' and plantilla_status='Habilitado'");
                    

                    while ($rs=mysqli_fetch_array($sql,MYSQLI_NUM)) {
                            for ($i=0; $i < $m->total_columnas_plantilla_revision(); $i++) { 
                            if($i >= 3){
                               $datos[] = $rs[$i];
                            }
                        }                        
                    }

                    /// GUARDAR LAS ULTIMAS COLUMNAS 
                    $total = $m->total_columnas_plantilla() - 3;

                    $col = mysqli_query($m->conexion(), "SHOW COLUMNS FROM plantilla");

                    while($rows=mysqli_fetch_array($col,MYSQLI_ASSOC)){
                            if($rows['Field'] != 'id_plantilla' && $rows['Field'] != 'id_equipo' && $rows['Field'] != 'plantilla_status') {
                              $columnas[] = $rows['Field'];
                            }
                    } 

                    $x=0;

                    foreach ($datos as $key => $value) {
                        if($value[0] == 'H'){
                           $result = $result.'<div class="form-group"><label>'.$columnas[$x].'</label><input id="" name="'.$columnas[$x].'" class="form-control" type="text" required></div>';
                        }
                         $x++; 
                    }
                   ?>
                   <?php
                   if($datos[1] == false) {
                       ?>
                       <div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong>Error! </strong> No existe plantilla para este equipo.<a href="javascript:history.back();" class="btn"> Volver</a>
                        </div>
                       <?php
                      }
                   else
                   {
                   ?>
                   <div class="table table-responsive">
                   <form action="" method="POST">
                    <?php echo $result; ?>   
                    <div class="form-group">
                    <label for="exampleInputEmail1">Comentario Adicional</label>
                    <textarea name="comentario" cols="1"  rows="4" class="form-control"></textarea>                   
                    </div>     
                      <button type="submit" name="submit" class="btn btn-success">Finalizar</button>
                       <button type="button" data-toggle="modal" id="registrarFallas" data-target="#myModal" 
                       class="btn btn-danger">Registrar Falla</button>
                    </form>                    
                    </div>
                     <div id="registrarFalla" style="display: none;">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Registrar Falla</div>
                        <div class="panel-body">
                          <div id="msg"></div>
                          <div class="form-group">
                            <input type="hidden" class="form-control" name="equipo" id="equipo" value="<?php echo $_GET['id_equipo']; ?>" readonly disabled>
                            <input type="hidden" name="id_inspeccion" id="id_inspeccion" value="<?php echo $_GET['id_inspeccion']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tipo de Falla</label>
                            <select name="tipo_falla" id="tipo_falla" class="form-control">
                               <?php  echo $m->listar_tipo_falla(); ?>
                            </select>
                          </div>
                          <div class="form-group">
                          <label>Falla registrada 1</label>
                          <textarea class="form-control" name="falla_registrada" id="falla1"></textarea>
                          </div>
                           <div class="form-group">
                          <label>Recomendación/Acotación (Opcional)</label>
                          <textarea class="form-control" name="falla_registrada" id="falla2"></textarea>
                          </div>
                           <button type="button" name="registrar" id="registrar" class="btn btn-primary">Registrar Falla</button>
                          </div>
                        </div>
                      </div>
                      </div>
                   <?php
                  }
                 }
                else
                {
                  if(isset($_POST['Buscar']))
                  {
                    ?>
                    <style type="text/css">
                    #byUser {
                      display: none;
                    }
                    </style>
                    <div class="table-responsive" id="byFecha">
                     <table class="table table-bordered">
                         <tr>
                             <th class="info">Area</th>
                             <th class="info">Maquina</th>
                             <th class="info">Equipo</th>
                             <th class="info">Operador</th>
                             <th class="info">Fecha de Inicio</th>
                             <th class="info">Fecha de Termino</th>
                             <th class="info">Estado General</th>
                             <th class="info">Acción</th>
                         </tr>
                         <?php  echo $m->Listar_Inspecciones_by_fecha($_SESSION['rut'],$_POST['fecha_inicio'],$_POST['fecha_termino']); ?>
                     </table> 
                     </div>
                    <?php
                    }
                    ?>
                    <div id="byUser">
                    <div class="table-responsive" >
                    <table class="table table-bordered" >
                         <tr>
                             <th class="info">Area</th>
                             <th class="info">Maquina</th>
                             <th class="info">Equipo</th>
                             <th class="info">Operador</th>
                             <th class="info">Fecha de Inicio</th>
                             <th class="info">Fecha de Termino</th>
                             <th class="info">Estado General</th>
                             <th class="info">Acción</th>
                         </tr>
                         <?php echo $m->Listar_Inspecciones_by_user($_SESSION['rut']); ?>
                     </table> 
                     </div>
                     </div>
                  <?php
                }
               ?>  
          </div>        
        </div>
        <?php }  else { 
        ?>
         <!-- Page Heading -->
        <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Bienvenido <?php echo $_SESSION['nombre']; ?> (<?php echo $m->get_rol_id($_SESSION['rol_usuario']); ?>) </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"></a>
            </li>
           </ol> 
            <div class="panel panel-default">
              <div class="panel-heading"></div>
              <div class="panel-body">
              
              </div>
            </div>
          </div>
        </div>

        <?php } ?>
         <script type="text/javascript">
          $(function () {
                  $('[data-toggle="popover"]').popover()
          });
          </script>
          <script type="text/javascript">
          
              function myFunction(id_inspeccion) {

                      var data = 'id_inspeccion='+id_inspeccion;

                       $.ajax({
                            type: 'GET',
                            data: data,
                            url : "ajax/VerReporte.php",
                         beforeSend: function() {
                              $("#byUser").html('<center><img src="img/ajax-loader-exel.gif" alt=""></center>');
                              
                          },
                          success: function(response) {
                               $("#byUser").html(response);
                          }
                       });
              }
         
              $('#fecha_inicio').datetimepicker();
              $('#fecha_termino').datetimepicker();
          </script>
    </div>
</div>