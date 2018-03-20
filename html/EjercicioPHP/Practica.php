<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Practica PHP</title>
</head>
<body>

<?php
include("paginas/conexion.php");

if(isset($_POST['registrar']))
{
	if(isset($_POST['user']) && !empty($_POST['user']) &&
	isset($_POST['pass']) && !empty($_POST['pass']))
	{
		$usuario = $_POST['user'];
		$pass = $_POST['pass'];
		
		mysql_query("insert into usuarios(Usuario, Password) VALUES('$usuario', '$pass')", $conexion) or die(mysql_error());
		
		echo "<p style='color:green;'>INSERCION REALIZADA CON EXITO</p>";
	}
	else
	{
		
	}
}
?>
<form name="formulario" method="post" action="">
     
    <input placeholder="Usuario" type="text" name="user" maxlength="30" size="40">
    
    <input placeholder="Contraseña" type="password" name="pass" maxlength="30" size="40">
    
    <input  type="submit"  value="Registrar" name="registrar">
    
</form>
<br />
<a href="index.php">Regresar</a>

</body>
</html>