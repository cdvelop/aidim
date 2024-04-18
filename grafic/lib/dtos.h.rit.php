<?php
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("comysql.php");
// config de conexion a db

switch ($_GET['Consultar']) {
	// BUSCAR ULTIMO DATO
	case 1:
		$return_arr = array();
	
		$mysql->SetFetchMode(ADODB_FETCH_ASSOC);
		$dia = 0;
		foreach($mysql->Execute("SELECT SUBSTRING(REPLACE(fecha_his,'/',''),1,2) AS D, 
		SUBSTRING(REPLACE(fecha_his,'/',''),3,2) AS M,
		SUBSTRING(REPLACE(fecha_his,'/',''),5,4) AS Y, 
		hora_his AS H, 
		CAST(ritmo_his AS DECIMAL(5,2)) AS V1 
		FROM history ORDER BY id_his ASC") as $row){
		
		$otrodia = $row['D'];
		$v1 = $row['V1']*1;
		
		$date = @date_create($row['H']." ".$row['M']."/".$otrodia."/".$row['Y']);
		
		//el inicio de las variables minimo maximo
		if($dia==0){$mi=$v1;$ma=$v1;$dia=01;}

		if ($v1 < $ma) 
		   {$mi = $v1;}

		if ($v1 > $ma) 
		   {$ma = $v1;}

		if ($otrodia == $dia) {
		$row_array[0] = date_timestamp_get($date)*1000;
		$row_array[1] = $mi;
		$row_array[2] = $ma;}

		if ($otrodia != $dia) {	
		// si es otro dia agregamos los datos al array
		array_push($return_arr,$row_array);
		$dia = $otrodia;
		$ma=$v1;}



		}//fin foreach
		// si es  el fin de los datos agregamos el ultimo dia al array
		array_push($return_arr,$row_array);
		//transformamos a formato json
		$json=json_encode($return_arr, JSON_NUMERIC_CHECK);
		//mostramos
		echo $json;

		break;
	
	default:

		$return_arr = array();
	
		$mysql->SetFetchMode(ADODB_FETCH_ASSOC);
		$dia = 0;
		foreach($mysql->Execute("SELECT SUBSTRING(REPLACE(fecha_his,'/',''),1,2) AS D, 
		SUBSTRING(REPLACE(fecha_his,'/',''),3,2) AS M,
		SUBSTRING(REPLACE(fecha_his,'/',''),5,4) AS Y, 
		hora_his AS H, 
		CAST(ritmo_his AS DECIMAL(5,2)) AS V1 
		FROM history ORDER BY id_his ASC") as $row){
		
		$otrodia = $row['D'];
		$v1 = $row['V1']*1;
		
		$date = @date_create($row['H']." ".$row['M']."/".$otrodia."/".$row['Y']);
		
		//el inicio de las variables minimo maximo
		if($dia==0){$mi=$v1;$ma=$v1;$dia=01;}

		if ($v1 < $ma) 
		   {$mi = $v1;}

		if ($v1 > $ma) 
		   {$ma = $v1;}

		if ($otrodia == $dia) {
		$row_array[0] = date_timestamp_get($date)*1000;
		$row_array[1] = $mi;
		$row_array[2] = $ma;}

		if ($otrodia != $dia) {	
		// si es otro dia agregamos los datos al array
		array_push($return_arr,$row_array);
		$dia = $otrodia;
		$ma=$v1;}



		}//fin foreach
		// si es  el fin de los datos agregamos el ultimo dia al array
		array_push($return_arr,$row_array);
		//transformamos a formato json
		$json=json_encode($return_arr, JSON_NUMERIC_CHECK);
		//mostramos
		echo $json;
		break;
}


?>

