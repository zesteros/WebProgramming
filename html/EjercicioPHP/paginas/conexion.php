<?php
// datos para la coneccion a mysql 
$hostdb= "localhost";
$userdb= "root";
$passdb= "root";
$db= "prueba";

//Realizamos la conexion
$conexion = mysql_connect($hostdb,$userdb,$passdb);

//Estructura de control por si falla
if(!$conexion)
{
die("No he podido conectar porque: ".mysql_error());
}
//Seleccion la base de datos
mysql_select_db($db,$conexion);

?>