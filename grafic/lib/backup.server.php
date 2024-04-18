<?php
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("conec.php");
include("comysql.php");
// config de conexion a db

// variables get
$caso = $_GET['backupms'];
$mes = 	$_GET['mes'];
$seg = 	$_GET['seg'];

switch ($caso) {
	
	case 1:
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		foreach($conexion->Execute("SELECT TOP 1 SUBSTRING(VARIABLE_FECHA,4,7) AS MES FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{$ME= $row['MES'];}	


		echo json_encode($ME);		
	break;

	case 2:
	//tomar datos server maquina
	// $conexion->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs = $conexion->Execute('SELECT 
	ITEM AS id_his, 
	SUBSTRING(VARIABLE_FECHA,1,10) AS fecha_his,
	SUBSTRING(VARIABLE_FECHA,12,8) AS hora_his, 
	CONVERT(INT(5,2),ROUND(VARIABLE_1,2)) AS temp_his, 
	CONVERT(INT(5,2),ROUND(VARIABLE_2,2)) AS vibra_his,
	CONVERT(INT(5,2),ROUND(VARIABLE_3,2)) AS dispo_his,
	CONVERT(INT(5,2),ROUND(VARIABLE_3,2)) AS ritmo_his,
	CONVERT(INT(5,2),ROUND(VARIABLE_3,2)) AS calid_his
	FROM VARIABLES WHERE (SUBSTRING(VARIABLE_FECHA,4,2)='.$mes.'-1)
	AND 
	SUBSTRING(VARIABLE_FECHA,18,2)%'.$seg.'=0 ORDER BY ITEM ASC');

	$msql = $rs->GetRows();

	$tabla = 'history';

	$mysql->autoExecute($tabla,$msql,'INSERT');





		
	break;
	
	default:
	
		$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

		foreach($conexion->Execute("SELECT TOP 1 SUBSTRING(VARIABLE_FECHA,4,7) AS MES FROM VARIABLES ORDER BY ITEM DESC") as $row)   
		{$ME = $row['MES'];}	
		

		echo json_encode($ME);
	break;
}

?>

