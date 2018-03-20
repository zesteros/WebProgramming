<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Practica PHP</title>
</head>
<body>

<?php
include("paginas/conexion.php");


		
		$consulta = mysql_query("SELECT * FROM usuarios", $conexion) or die(mysql_error());
		
?>

			<table width="40%" border="1">
            <tr>
				<td>USUARIO</td>
				<td>PASSWORD</td>
			  </tr>
<?php
		
		while($filas = mysql_fetch_array($consulta))
		{	
			$user=$filas['Usuario'];
			$pass=$filas['Password'];
			
?>
			  <tr>
				<td><?php echo "<p style='color:#666;'>".$user."</p>";?></td>
				<td><?php echo "<p style='color:#ccc;'>".$pass."</p>";?></td>
			  </tr>
<?php
			
			
		}


?>
</table>
<br />
<a href="index.php">Regresar</a>

</body>
</html>