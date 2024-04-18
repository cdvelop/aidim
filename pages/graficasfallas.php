<script type="text/javascript">
	$(document).ready(function(){
		$("#ver_grafico").click(function(){
			$.ajax({
			 	    type: 'GET',
				    url : "pages/graficos_fallas.php",
			   beforeSend: function() {
			        $("#grafico").html('<center><img src="img/ajax-loader-exel.gif" alt=""></center>');
			        
			    },
			    success: function(response) {
			         $("#grafico").html(response);
			    }
			 });	
		});
	});
</script>
<div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small></small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s'];?>&status=true"> Lista de fallas</a>
            </li>
           </ol>
           <div class="panel panel-default">
			  <div class="panel-heading">
			  <form action="" method="POST" class="form-inline">
			   <input type="text" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha Desde:" class="form-control input-sm">
            <input type="text" id="fecha_termino" name="fecha_termino" placeholder="Fecha Hasta:" class="form-control input-sm">
			  <select name="tipofalla" id="tipo_falla" class="form-control input-sm">
			  	<option value="0">Seleccionar.</option>
			  	<option value="1">Urgente</option>
			  	<option value="2">Planificada</option>
			  	<option value="3">Emergencia</option>
			  </select>
			  <input type="text" name="nombre_equipo" class="form-control input-sm" placeholder="Equipo: B-323.01">
             <input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-success btn-xs">
			  <a href="#" id="ver_grafico" class="btn btn-danger btn-xs">Ver Graficos</a></div> 
			  </form>
			  <div class="panel-body">
			  <div id="grafico">
			  <div class="table-responsive">
			  <?php 
			  if(isset($_POST['buscar']) == 'Buscar') {

			  		$fecha_inicio = $m->scape($_POST['fecha_inicio']);
			  		$fecha_termino = $m->scape($_POST['fecha_termino']);
			  		$tipo_falla = $m->scape($_POST['tipofalla']);
			  		$nombre_equipo = trim($m->scape($_POST['nombre_equipo']));


			  		// BUSCAR POR FECHA

			  		if($fecha_inicio && $fecha_termino) {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla WHERE fecha_falla >= '".$fecha_inicio."' AND fecha_falla <= '".$fecha_termino."'");
			  		}
			  		// BUSCAR POR FECHA Y TIPO
			  		else if($fecha_inicio && $fecha_termino && $tipo_falla) {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla WHERE fecha_falla >= '".$fecha_inicio."' AND fecha_falla <= '".$fecha_termino."' AND tipo_falla = '".$tipo_falla."' AND tipo_falla = '".$tipo_falla."'");
			  		}
			  		
			  		// BUSCAR POR FECHA TIPO Y EQUIPO
			  		else if($fecha_inicio && $fecha_termino && $tipo_falla && $nombre_equipo) {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla WHERE fecha_falla >= '".$fecha_inicio."' AND fecha_falla <= '".$fecha_termino."' AND tipo_falla = '".$tipo_falla."' AND tipo_falla = '".$tipo_falla."' AND id_equipo ='".$m->get_equipo_id($nombre_equipo)."'");
			  		}
			  		// BUSCAR POR FECHA I FECHA T TIPO FALLA VACIO Y NOMBRE EQUIPO VERDADERO
			  		else if(!$fecha_inicio && !$fecha_termino && !$tipo_falla && $nombre_equipo) {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla WHERE id_equipo = '".$m->get_equipo_id($nombre_equipo)."'");
			  		}
			  		// BUSCAR POR FECHA I FECHA T NOMBRE EQUIPO VACIO Y TIPO_FALLA VERDADERO
			  		else if(!$fecha_inicio && !$fecha_termino && $tipo_falla && !$nombre_equipo) {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla WHERE tipo_falla = '".$tipo_falla."'");
			  		}
			  	
			  		// BUSCAR VACIOS
			  		else {
			  			$sql = mysqli_query($m->conexion(), "SELECT * FROM falla");
			  		
			  		}
			  		?>
					<table class="table table-striped table-hover">
			    	<tr>
			    		<th>#</th>
			    		<th>Equipo</th>
			    		<th>Tipo</th>
			    		<th>Fecha</th>
			    		<th>Falla-1</th>
			    		<th>Falla-2</th>
			    	</tr>
			  		<?php
			  		$i=1;
			  		while ($rows = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
			  			$result = $result.'<tr>';
				 		$result = $result.'<td>'.$i++.'</td>';
				 		$result = $result.'<td>'.$m->get_name_equipo($rows['id_equipo']).'</td>';
				 		$result = $result.'<td>'.$m->get_type_falla($rows['tipo_falla']).'</td>';
				 		$result = $result.'<td>'.$rows['fecha_falla'].'</td>';
				 		$result = $result.'<td><textarea readonly>'.$rows['falla_1'].'</textarea></td>';
				 		$result = $result.'<td><textarea readonly>'.$rows['falla_2'].'</textarea></td>';
				 		$result = $result.'</tr>';
			  		}

					echo $result;
			  		
			  }
			  else
			  {
			  ?>
			    <table class="table table-striped table-hover">
			    	<tr>
			    		<th>#</th>
			    		<th>Equipo</th>
			    		<th>Tipo</th>
			    		<th>Fecha</th>
			    		<th>Falla-1</th>
			    		<th>Falla-2</th>
			    	</tr>
			    		<?php echo $m->listar_fallas(); ?>
			    </table>
			    <?php } ?>
			   </div>
			   </div>
			  </div>
			</div>
          </div>
         </div>
         <script type="text/javascript">
              $('#fecha_inicio').datetimepicker();
              $('#fecha_termino').datetimepicker();
       </script> 