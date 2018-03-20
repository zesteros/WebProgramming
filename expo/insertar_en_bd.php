<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include 'database.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];

$db = new database();

$db->insertar($id,$nombre,$correo);

echo "Registro exitoso.";
?>
<br>
<a href="index.php">Regresar</a>
</body>
</html>
