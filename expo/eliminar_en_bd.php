<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	include 'database.php';

	$id = $_GET["id"];

	$db = new database();

	$db->eliminar($id);

	echo "Eliminación exitosa";
?>
<br>
<a href="modificar.php">Regresar</a>
</body>
</html>


