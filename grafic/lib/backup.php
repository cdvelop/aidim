<?php
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("conec.php");
include("comysql.php");
// config de conexion a db
// variables get
// variables get
$caso = $_GET['backupms'];
$mes = 	$_GET['mes'];
$seg = 	$_GET['seg'];

	//tomar datos server maquina
	$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

	$rs = $conexion->Execute('SELECT
		ITEM, 
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

	  // averiguar si el dia que vamos a incertar existe el la db aidim
	  $diaplc = $msql[1]['fecha_his'];
	  echo "dia plc = ".$diaplc;

	  $rsdim = $mysql->Execute('SELECT * FROM history WHERE fecha_his ="'.$diaplc.'" LIMIT 1');   
	  $diaexist = $rsdim->GetRows();	
	  // var_dump($diaexist);

	  if (!empty($diaexist)) {
	  	echo "dia ya esta respaldado";
	  	
	  }else{//solo si no se encuentra la fecha incertamos datos

		//insertamos el array en la db aidim
		$tabla = 'history';
	    foreach ($msql as $k => $value) {
	    	$mysql->autoExecute($tabla,$value,'INSERT');
	    }
	    $conexion->Close();

	  	echo "datos incertados";
	  }

	  





	    







?>

