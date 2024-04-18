<?php
$status = htmlentities($_POST['status']); 
require_once('Classes/PHPExcel.php');
?>

<script type="text/javascript">
function verInspeccion(response) {

    var data = 'inspeccion='+response;

    $.ajax({
        type: 'GET',
        data: data,
        url: 'ajax/buscarReportes.php',
        beforeSend: function() {
            $('#cargaReporte').html('<center><img src="img/ajax-loader-exel.gif" alt="reportes"></center>');
        },

        success: function(data) {
            $('#cargaReporte').html(data);
        }
    })
}


$(document).ready(function(){
    $("#select-filtro").change(function(e){
        e.preventDefault();
        
        var select = $('#select-filtro').val();
        var data = 'db='+select;

        $.ajax({
                type: 'GET',
                url: 'ajax/filtroBusqueda.php',
                data: data,
            success: function(data) {
                $('#resultado').html(data);
            }
        });
    });
});  
</script>
<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <?php 
            if(htmlentities($_GET['status']) == 1) {
                    $inspeccion = 'Realizadas';
                    $status = true;
            }
            else {
                    $inspeccion = 'No Realizadas';
                    $status = false;
            }
            ?>
            <small>Lista de Inspecciones <?php echo $inspeccion; ?></small>
            </h1>
            <div class="well">
                <div class="table-responsive">
                    <table class="table"> 
                        <td>
                            <form action="index.php?s=inspecciones&status=<?php echo $status; ?>" method="POST" id="form-filtro" class="form-inline">
                                <input type="text" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha Desde:" class="form-control input-sm">
                                <input type="text" id="fecha_termino" name="fecha_termino" placeholder="Fecha Hasta:" class="form-control input-sm">
                                <div class="form-group">
                                 <select id="select-filtro" name="select-filtro" class="form-control input-sm">
                                    <option value="">Seleccionar..</option>
                                    <option value="1">Area</option>
                                    <option value="2">Maquina</option>
                                    <option value="3">Equipo</option>
                                    <option value="4">Operador</option>
                                </select>
                                <span id="resultado">                           
                                </span>
                                <input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-success btn-xs">
                              </div>                               
                            </form>                           
                        </td>
                        <td>Imprimir <a href="#" onClick="javascript:imprSelec('seleccion')"><img src="img/impresora.png" width="25"></a></td>
                            <td> <form action="ficheroExcel.php" class="form-inline" method="post" target="_blank" id="FormularioExportacion">
                            <p>Exp. a Excel  <img src="img/excel.png" class="botonExcel" /></p>
                            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                            </form> </td>
                           <td> Exp. a PNG <a href="#" onClick ="$('#tablaExcel').tableExport({type: 'png', escape: 'false'});"> <img src='https://upload.wikimedia.org/wikipedia/commons/5/50/Redmine_bt_img.png' width="24"/></a></td><td>
                            Exp. PDF <a href="#" target="_blank" onClick ="$('#tablaExcel').tableExport({type: 'pdf', escape: 'false'});"><img src='http://mensajedelacruz.com.ar/wp-content/uploads/2014/06/pdf-ico.png' width="24"/></a></td>           
                     
                 </table>
            </div>
            </div>
            <?php
                if(isset($_POST['buscar']) == 'Buscar') {

                        $fecha_inicio = $_POST['fecha_inicio'];
                        $fecha_termino = $_POST['fecha_termino'];
                        $filtro = $_POST['select-filtro'];
                        
                        $area = $_POST['area']; 
                        $maquina = $_POST['maquina'];
                        $equipo = $_POST['equipo'];
                        $operador = $_POST['rut'];                      

                        // CAMPOS VACIOS
                        if($fecha_inicio == '' && $fecha_termino == '' && $filtro == '') {
                        ?>
                        <div class="table-responsive" id="cargaReporte">
                            <table class="table table-bordered" >
                                 <tr>
                                     <th class="info">#</th>
                                     <th class="info">Tipo</th>
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
                                 <?php echo $m->Listar_Inspecciones_reporte($inspeccion); ?>
                             </table> 
                         </div>
                         <?php
                        }
                        else {
                           ?>
                        <div class="table-responsive" id="cargaReporte">
                            <table class="table table-bordered">
                                 <tr>
                                     <th class="info">#</th>
                                     <th class="info">Tipo</th>
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
                                 <?php echo $m->Listar_Inspecciones_reporte_filtro($status,$filtro,$area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino); ?>
                             </table> 
                             </div>
                           <?php 
                        }
                        // else 
                    }
                else
                {
            ?>
            <div class="table-responsive" id="cargaReporte">
            <table class="table table-bordered">
                 <tr>
                     <th class="info">#</th>
                     <th class="info">Tipo</th>
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
                 <?php echo $m->Listar_Inspecciones_reporte($inspeccion); ?>
             </table> 
            </div> 
            <?php   
                }
            ?>
           <script type="text/javascript">
              $(function () {
                      $('[data-toggle="popover"]').popover()
                    });
           </script>
            
           <script type="text/javascript">
              $('#fecha_inicio').datetimepicker();
              $('#fecha_termino').datetimepicker();
              </script>      
    </div>
</div>