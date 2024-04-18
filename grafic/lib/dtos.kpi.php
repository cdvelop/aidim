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

		foreach($conexion->Execute("SELECT TOP 1 
		CONVERT(INT(5,2),ROUND(VARIABLE_3,2)) AS d,
		CONVERT(INT(5,2),ROUND(VARIABLE_4,2)) AS r,
		CONVERT(INT(5,2),ROUND(VARIABLE_5,2)) AS c  
		FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{

			$d = $row['d']*1;
			$r = $row['r']*1;
			$c = $row['c']*1;
		}	
		$ret = array($d,$r,$c);


		// $y=rand(3,65);$ret = array($y);


		echo json_encode($ret);		
		break;
	
	default:
	
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		foreach($conexion->Execute("SELECT TOP 1 
		CONVERT(INT(5,2),ROUND(VARIABLE_3,2)) AS d,
		CONVERT(INT(5,2),ROUND(VARIABLE_4,2)) AS r,
		CONVERT(INT(5,2),ROUND(VARIABLE_5,2)) AS c  
		FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{

			$d = $row['d']*1;
			$r = $row['r']*1;
			$c = $row['c']*1;
		}	
		$ret = array($d,$r,$c);


		// $y=rand(3,65);$ret = array($y);


		echo json_encode($ret);
		break;
}

?>

