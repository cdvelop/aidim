<?php
require('../config/mysql.php');

$m = new Mysql();

sleep(1);

$id_inspeccion = $_GET['inspeccion'];

$inspecciones = mysqli_query($m->conexion(), "SELECT * FROM inspeccion WHERE id_inspeccion='".$id_inspeccion."'");
$resultado = mysqli_fetch_array($inspecciones,MYSQLI_ASSOC);

$falla = mysqli_query($m->conexion(), "SELECT * from falla WHERE id_inspeccion=".$id_inspeccion."");

$fetch=mysqli_fetch_array($falla,MYSQLI_ASSOC);


 $sql = mysqli_query($m->conexion() ,"SELECT * FROM plantilla_revision WHERE id_inspeccion='".$id_inspeccion."'");
                    

                    while ($rs=mysqli_fetch_array($sql,MYSQLI_NUM)) {
                            for ($i=0; $i < $m->total_columnas_plantilla_revision_ajax(); $i++) { 
                            if($i >= 3){
                               $datos[] = $rs[$i];
                            }
                        }                        
                    }

$col = mysqli_query($m->conexion(), "SHOW COLUMNS FROM plantilla_revision");

                    while($rows=mysqli_fetch_array($col,MYSQLI_ASSOC)){
                            if($rows['Field'] != 'id_plantilla_revision' && $rows['Field'] != 'id_inspeccion' && $rows['Field'] != 'id_equipo') {
                              $columnas[] = $rows['Field'];
                            }
                    } 

                    $x=0;
                    $result = $result.'<div class="col-md-10 col-md-offset-1" id="seleccion"><table class="table table-bordered" id="tablaExcel" border="1"><tr><td align="center" colspan="2"><img src="http://concursoarauco.cl/imagenes/logo-arauco.png" width="30%"><hr><br><center><h4 style="text-decoration:underline;">DATOS DE INSPECCION</h4></center></td></tr><tr><td>Codigo</td><td>'.$fetch['id_inspeccion'].'</td></tr><tr><td>Tipo</td><td>'.$m->get_rol_inspeccion_operador($fetch['id_operador']).'</td></tr><tr><td>Fecha Inicio</td><td>'.$resultado['fecha_inicio'].'</td></tr><tr><td>Fecha Termino</td><td>'.$resultado['fecha_termino'].'</td></tr><tr><td>Estado</td><td>'.$m->status_inspecciones_reporte($resultado['status_general']).'</td></tr><tr><td>Area</td><td>'.$m->get_area_id_nombre($resultado['id_area']).'</td></tr><tr><td>Maquina</td><td>'.$m->get_maquina_id_nombre($resultado['id_maquina']).'</td></tr><tr><td>Equipo</td><td>'.$m->get_equipo_id_nombre($resultado['id_equipo']).'</td></tr><tr><td>Equipo</td><td>'.$m->obtener_nombre_operador($fetch['id_operador']).'</td></tr><tr><td colspan="2"><center><h4 style="text-decoration:underline;">DATOS REGISTRADOS</h4></center></td></tr>';
                        foreach ($datos as $key => $value) {
                            if($value[0]){
                               $result = $result.'<tr><td>'.$columnas[$x].':</td><td>'.$datos[$x].'</td></tr>';
                            }
                             $x++; 
                        }
                        $result = $result.'<tr><td colspan="2"><center><h4 style="text-decoration:underline;">FALLA REGISTRADA</h4></center></td></tr><tr><tr><td>Categoria:</td><td>'.$m->get_type_falla($fetch['tipo_falla']).'</td></tr><tr><td>Falla:</td><td>'.$fetch['falla_1'].'</td></tr><tr><td>Recomendacion:</td><td>'.$fetch['falla_2'].'</td></tr><tr><td>Fecha Registrada:</td><td>'.$fetch['fecha_falla'].'</td></tr><td colspan="2"><hr><center>Copyright @2016 | Arauco </center></td></tr></table></div>';

echo trim($result);

?>