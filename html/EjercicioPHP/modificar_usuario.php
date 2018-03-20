<?php
ob_start();
include("paginas/conexion.php");
$ID = $_GET["ID"];

$consultas = mysql_query("SELECT * FROM usuarios WHERE Id_Usuario='".$ID."'", $conexion) or die(mysql_error());

		while($filax = mysql_fetch_array($consultas))
		{	
			$user=$filax['Usuario'];
			$pass=$filax['Password'];
		}
		
if(isset($_POST['modificar']))
{
	if(isset($_POST['user2']) && !empty($_POST['user2']) &&
	isset($_POST['pass2']) && !empty($_POST['pass2']))
	{
		$usuario2 = $_POST['user2'];
		$pass2 = $_POST['pass2'];
		
		mysql_query("UPDATE usuarios SET Usuario = '$usuario2', Password = '$pass2' WHERE Id_Usuario = '$ID'", $conexion) or die(mysql_error());
		
		header('refresh: 1; url=modificar.php');
		
		echo "<p style='color:green;'>MODIFICACION REALIZADA CON EXITO</p>";
	}
	else
	{
		echo "error";
	}
}
?>

<form name="formulario" method="post" action="">
     
    <input placeholder="" type="text" name="user2" value="<?php echo $user;?>" maxlength="30" size="40">
    
    <input placeholder="" value="<?php echo $pass;?>" type="text" name="pass2" maxlength="30" size="40">
    
    <input  type="submit"  value="Modificar" name="modificar">
    
</form>
<br />
<a href="modificar.php">Regresar</a>

</body>
</html>