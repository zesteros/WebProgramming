<!DOCTYPE html>
<html>
<head>
	<title>Impare</title>
</head>
<body>
<table>
<?php 
	for ($i=0; $i < 20; $i++) { 
			if ($i % 2 == 0) 
				echo "<tr bgcolor=red>";
			else echo "<tr>"
		for ($j=0; $j < 5; $j++) { 
			echo "renglon $i columna $j";
		}
		echo "</tr>";
	}
?>
</table>
</body>
</html>