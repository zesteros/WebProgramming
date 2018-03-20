<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		echo "ID A Modificar: $id";
	}

?>
<form action="actualizar_en_bd.php?id=<?php echo $id; ?>" method="post">
	ID
	<input type="text" name="id_nuevo">
	<br>
	Nombre
	<input type="text" name="nombre_nuevo">
	<br>
	Correo
	<input type="text" name="correo_nuevo">
	<br>
	<input type="submit" value="aceptar">
</form>
</body>
</html>
