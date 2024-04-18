<?php
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("conec.php");
// config de conexion a db

switch ($_GET['Consultar']) {
	// BUSCAR ULTIMO DATO
	case 1:
		$return_arr = array();
	
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		// foreach($conexion->Execute("select * from VARIABLES") as $row)
		foreach($conexion->Execute("SELECT TOP 1 SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),1,2) AS D, 
		SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),3,2) AS M,
		SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),5,4) AS Y, 
		SUBSTRING(VARIABLE_FECHA,12,8) AS H, 
		CAST(VARIABLE_1 AS NUMERIC(5,2)) AS V1 
		FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{
		
		$date = @date_create($row['H']." ".$row['M']."/".$row['D']."/".$row['Y']);
		$row_array['x'] = date_timestamp_get($date)*1000;

		$row_array['y'] = $row['V1']*1;

		array_push($return_arr,$row_array);

		}
		
		
		$json=json_encode($return_arr);
		echo $json;		

		break;
	
	default:
		$return_arr = array();
	
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		// foreach($conexion->Execute("select * from VARIABLES") as $row)
		foreach($conexion->Execute("SELECT SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),1,2) AS D, 
		SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),3,2) AS M,
		SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),5,4) AS Y, 
		SUBSTRING(VARIABLE_FECHA,12,8) AS H, 
		CAST(VARIABLE_1 AS NUMERIC(5,2)) AS V1 
		FROM VARIABLES ORDER BY ITEM ASC") as $row)   
		{
		
		$date = @date_create($row['H']." ".$row['M']."/".$row['D']."/".$row['Y']);
		$row_array['x'] = date_timestamp_get($date)*1000;

		$row_array['y'] = $row['V1']*1;

		array_push($return_arr,$row_array);

		}
		
		
		$json=json_encode($return_arr);
		echo $json;
		break;
}






?>

