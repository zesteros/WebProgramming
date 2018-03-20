<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
 
include 'database.php';

$id = $_GET["id"];
if(isset($_POST["id_nuevo"]) && isset($_POST["nombre_nuevo"]) && isset($_POST["correo_nuevo"])){
	$db = new database();

	$db->actualizar($id, $_POST["id_nuevo"], $_POST["nombre_nuevo"], $_POST["correo_nuevo"]);
	
	echo "Actualización exitosa";	
}
?>
<br>
<a href="index.php">Regresar</a>

</body>
</html>
