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
		CAST(dispo_his AS DECIMAL(5,2)) AS DIS,
		CAST(ritmo_his AS DECIMAL(5,2)) AS RIT,
		CAST(calid_his AS DECIMAL(5,2)) AS CAL
		FROM history ORDER BY id_his ASC") as $row){
		
		$otrodia = $row['D'];
		$dis = $row['DIS']*1;
		$rit = $row['RIT']*1;
		$cal = $row['CAL']*1;		
		


		$date = @date_create($row['H']." ".$row['M']."/".$otrodia."/".$row['Y']);

		//el inicio de las variables minimo maximo
		if($dia==0){
			$dia=01;

			$mindis=$dis;
			$maydis=$dis;

			$minrit=$rit;
			$mayrit=$rit;

			$mincal=$cal;
			$maycal=$cal;			

		}


		if ($dis < $maydis) 
		   {$mindis = $dis;}
		if ($dis > $maydis) 
		   {$maydis = $dis;}

		if ($rit < $mayrit) 
		   {$minrit = $rit;}
		if ($rit > $mayrit) 
		   {$mayrit = $rit;}

		if ($cal < $maycal) 
		   {$mincal = $cal;}
		if ($cal > $maycal) 
		   {$maycal = $cal;}


		if ($otrodia == $dia) {
		$row_array[0] = date_timestamp_get($date)*1000;
		
		$odis = ($mindis+$maydis)/2;
		$orit = ($minrit+$mayrit)/2;
		$ocal = ($mincal+$maycal)/2;

		$oee = (($odis/100)*($orit/100)*($ocal/100))*100;

		$row_array[1] = number_format($oee,1);


	    }

		if ($otrodia != $dia) {	
		// si es otro dia agregamos los datos al array
		array_push($return_arr,$row_array);
		$dia = $otrodia;
		$ma=$dis;

		}



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
		CAST(dispo_his AS DECIMAL(5,2)) AS DIS,
		CAST(ritmo_his AS DECIMAL(5,2)) AS RIT,
		CAST(calid_his AS DECIMAL(5,2)) AS CAL
		FROM history ORDER BY id_his ASC") as $row){
		
		$otrodia = $row['D'];
		$dis = $row['DIS']*1;
		$rit = $row['RIT']*1;
		$cal = $row['CAL']*1;		
		


		$date = @date_create($row['H']." ".$row['M']."/".$otrodia."/".$row['Y']);

		//el inicio de las variables minimo maximo
		if($dia==0){
			$dia=01;

			$mindis=$dis;
			$maydis=$dis;

			$minrit=$rit;
			$mayrit=$rit;

			$mincal=$cal;
			$maycal=$cal;			

		}


		if ($dis < $maydis) 
		   {$mindis = $dis;}
		if ($dis > $maydis) 
		   {$maydis = $dis;}

		if ($rit < $mayrit) 
		   {$minrit = $rit;}
		if ($rit > $mayrit) 
		   {$mayrit = $rit;}

		if ($cal < $maycal) 
		   {$mincal = $cal;}
		if ($cal > $maycal) 
		   {$maycal = $cal;}


		if ($otrodia == $dia) {
		$row_array[0] = date_timestamp_get($date)*1000;
		
		$odis = ($mindis+$maydis)/2;
		$orit = ($minrit+$mayrit)/2;
		$ocal = ($mincal+$maycal)/2;

		$oee = (($odis/100)*($orit/100)*($ocal/100))*100;

		$row_array[1] = number_format($oee,1);

	    }

		if ($otrodia != $dia) {	
		// si es otro dia agregamos los datos al array
		array_push($return_arr,$row_array);
		$dia = $otrodia;
		$ma=$dis;

		}



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

