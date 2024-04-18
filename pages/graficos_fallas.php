<style>
	.grafico {
		float:left;
	}
	.count {
		margin-left: 30px;
		font-size: 11px;
	}
</style>
<div class="col-md-6">
<?php
/** Include class */
include( '../gograph/GoogChart.class.php' );

/** Create chart */
$chart = new GoogChart();

require('../config/mysql.php');

function get_count_fail($id) {
	$m = new Mysql();
	$sql =mysqli_query($m->conexion(), "SELECT COUNT(*) as total FROM falla WHERE tipo_falla = ".$id."");
	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
	return $row['total'];
}			

$total_porcentaje = (get_count_fail(1) + get_count_fail(3) + get_count_fail(2));

$falla_urgente = (get_count_fail(1) * 100) / $total_porcentaje;
$falla_planificada = (get_count_fail(3) * 100) / $total_porcentaje;
$falla_emergencia = (get_count_fail(2) * 100) / $total_porcentaje;

$data = array(
			'Urgente' => get_count_fail(1),
			'Emergencia' => get_count_fail(3),
			'Planificadas' => get_count_fail(2),
		);

// Set graph colors
$color = array(
			'#FA5858',
			'#FF8000',
			'#819FF7',
		);

/* # Chart 1 # */
$chart->setChartAttrs( array(
	'type' => 'pie',
	'title' => 'Fallas registradas',
	'data' => $data,
	'size' => array( 400, 300 ),
	'color' => $color
	));
	
	echo $chart;	
?>
</div>
<style>
	.porcentaje_urgente {
		background-color: #FA5858;
		font-size: 28px;
		color: white;
	}
	.porcentaje_planificada {
		background-color: #FF8000;
		font-size: 28px;
		color: white;
	}
	.porcentaje_emergencia {
		background-color: #819FF7;
		font-size: 28px;
		color: white;
	}
	.fontTitle_urgente {
		background-color: #F6CECE;
	}
	.fontTitle_planificada {
		background-color: #F5D0A9;
	}
	.fontTitle_emergencia {
		background-color: #A9D0F5;
	}
</style>
<div class="col-md-6">
	<div class="panel panel-default">
	  <div class="panel-body">
	    <div class="count">
			<h6 style="text-decoration: underline;">Fallas por tipo</h6>			
			<table class="table table-bordered">
				<tr>
					<th class="fontTitle_urgente">Urgentes: <?php echo get_count_fail(1);  ?></th>
					<th class="fontTitle_planificada">Emergencia: <?php echo get_count_fail(3); ?></th>
					<th class="fontTitle_emergencia">Planificadas: <?php echo get_count_fail(2); ?></th>
				</tr>
				<tr>
					<td class="porcentaje_urgente"><?php echo round($falla_urgente); ?>%</td>
					<td class="porcentaje_planificada"><?php echo round($falla_planificada); ?>%</td>
					<td class="porcentaje_emergencia"><?php echo round($falla_emergencia); ?>%</td>
				</tr>
			</table>
			</div>
	  </div>
</div>
</div>


