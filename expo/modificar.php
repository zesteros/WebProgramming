<!DOCTYPE html>
<html>
<head>
    <title>Modificar</title>
</head>
<body>
<?php
    include 'database.php';

    $db = new database();

    $stmt = $db->consultar();

    $result = $stmt->fetchAll();
    $number_of_rows = $stmt->rowCount(); 
    

    if($number_of_rows > 0){
    	echo "<table border=1>";
	    echo "<th>ID</th>";
    	echo "<th>Nombre</th>";
    	echo "<th>Correo</th>";
        foreach ($result as $key => $value) {
            echo "<tr>";
            echo "<td>".$value['id']."</td>";
            echo "<td>".$value['nombre']."</td>";
            echo "<td>".$value['correo']."</td>";
            echo "<td><a href='actualizar.php?id=".$value["id"]."'>Modificar</a>
            	<br>
            	<a href='eliminar_en_bd.php?id=".$value["id"]."'>Eliminar</a></td>";
            echo "</tr>";
        }

    } else echo "No hay resultados."

?>
<br>
<a href="index.php">Regresar</a>
</body>
</html>