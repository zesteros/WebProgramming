<?php
ob_start();
include("paginas/conexion.php");

		
		$consulta = mysql_query("SELECT * FROM usuarios", $conexion) or die(mysql_error());
		
?>

			<table width="40%" border="1">
            <tr>
				<td>USUARIO</td>
				<td>PASSWORD</td>
                <td>ACCION</td>
			  </tr>
<?php
		
		while($filas = mysql_fetch_array($consulta))
		{	
			$IDu=$filas['Id_Usuario'];
			$user=$filas['Usuario'];
			$pass=$filas['Password'];
			
?>
			  <tr>
				<td><?php echo "<p style='color:#666;'>".$user."</p>";?></td>
				<td><?php echo "<p style='color:#ccc;'>".$pass."</p>";?></td>
                <td>
                	<form method="post" action="">
                    	<input type="submit" value="Eliminar" name="eliminar" />
                    </form>
                </td>
			  </tr>
<?php
			
			
		}
		
		
if(isset($_POST['eliminar']))
{
		
		mysql_query("DELETE FROM usuarios WHERE Id_Usuario = '$IDu'", $conexion) or die(mysql_error());
		
		header('refresh: 1; url=eliminar.php');
		
		echo "<p style='color:green;'>ELIMINACION REALIZADA CON EXITO</p>";
}


?>
</table>
<br />
<a href="index.php">Regresar</a>

</body>
</html>