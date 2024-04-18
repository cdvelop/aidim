<?php
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("conec.php");
// config de conexion a db

switch ($_GET['Consultar']) {
	// BUSCAR ULTIMO DATO
	case 1:
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		foreach($conexion->Execute("SELECT TOP 1 CONVERT(INT(5,2),ROUND(VARIABLE_1,2)) AS y FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{$y = $row['y']*1;}	
		$ret = array($y);


		// $y=rand(3,65);$ret = array($y);


		echo json_encode($ret);		
		break;
	
	default:
	
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		foreach($conexion->Execute("SELECT TOP 1 CONVERT(INT(5,2),ROUND(VARIABLE_1,2)) AS y FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{$y = $row['y']*1;}	
		$ret = array($y);


		// $y=rand(60,60);$ret = array($y);


		echo json_encode($ret);
		break;
}

?>

