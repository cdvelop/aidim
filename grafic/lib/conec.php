<?php
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/

$dbserver= "Driver={SQL Server};Server=192.168.2.252,1433;Database=HISTORY;";
$user = 'administrador';
$pass = '123456';

$conexion = &ADONewConnection(odbc_mssql);
/* Creamos un objeto de conexión a SQL Server */
$datos = $dbserver;
/* Definimos nuestro DSN */
$conexion->Connect($datos,$user,$pass);
/* Hacemos la conexión con los parámetros correspondientes */

// SI FALLA LA CONEXION VOLVER A INTENTAR 1 vez
if (!$conexion->isConnected()){
$conexion = &ADONewConnection(odbc_mssql);
$datos = $dbserver;
$conexion->Connect($datos,$user,$pass);
}

?>

