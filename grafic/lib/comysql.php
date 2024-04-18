<?php
include("adodb/adodb.inc.php");
/* Incluimos el archivo de funciones sql adodb5*/
$mysql = ADONewConnection(mysql);

$dbserver= "localhost";
$user = 'root';
$pass = '123456789';
$dbase = 'tesis';

/* Definimos nuestro DSN */
$mysql->Connect($dbserver,$user,$pass,$dbase);
/* Hacemos la conexión con los parámetros correspondientes */

// SI FALLA LA mysql VOLVER A INTENTAR 1 vez
if (!$mysql->isConnected()){
$mysql = ADONewConnection(mysql);
$mysql->Connect($dbserver,$user,$pass,$dbase);
}

// $mysql->SetFetchMode(ADODB_FETCH_ASSOC);


// $rs = $mysql->Execute('SELECT * FROM history');

// print "<pre>";
// print_r($rs->GetRows());
// print "</pre>";
?>

