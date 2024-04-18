<?php
// Set the JSON header
header("Content-type: text/json");
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
include("conec.php");
// config de conexion a db

$conexion->SetFetchMode(ADODB_FETCH_ASSOC);

// foreach($conexion->Execute("select * from VARIABLES") as $row)
foreach($conexion->Execute("SELECT TOP 1 SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),1,2) AS D, 
SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),3,2) AS M,
SUBSTRING(REPLACE(VARIABLE_FECHA,'/',''),5,4) AS Y, 
SUBSTRING(VARIABLE_FECHA,12,8) AS H, 
CAST(VARIABLE_2 AS NUMERIC(5,2)) AS V1
FROM VARIABLES ORDER BY ITEM DESC") as $row)   
{

$y = $row['V1']*1;

$D = $row['D']*1;
$M = $row['M']*1;
$Y = $row['Y']*1;
$H = $row['H'];


}


$date = @date_create($H." ".$M."/".$D."/".$Y);
$x = date_timestamp_get($date)*1000;



$ret = array($x,$y);
echo json_encode($ret);
?>