<?php 
  include 'database.php';
  // muestra el formato internacional para la configuración regional es_MX
  setlocale(LC_MONETARY, 'es_MX');
  session_start();
  if(!isset($_SESSION["username"])) header("location:index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <script src="js/jquery-3.2.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/home-style-sheet.css">
  <script src="js/home-script.js"></script>
  <title>Hola</title>
</head>
<body>
<div id="iframe">
  <div class="search-box" align="center"><input type="text" id="search-product" name="search" placeholder="Buscar producto..." size="30"  onkeydown = "if (event.keyCode == 13) document.getElementById('search-button').click()"> 
    <button id="search-button" onclick="searchProduct()">
      <svg id="search-icon" class="search-icon" viewBox="0 0 24 24">
        <path id="search-button-svg" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="white"/>
        <path d="M0 0h24v24H0z" fill="none"/>
      </svg>
    </button>
    <div id="dollar-price"/>
    <div>
       En la tienda:
       
    <select>
      <?php 
        $db = new database();
        $stmt = $db->getStores();
        $result = $stmt->fetchAll();
        $number_of_rows = $stmt->rowCount(); 
        if($number_of_rows > 0){
          foreach ($result as $key => $value) {
            $id_store = $value["id_store"];
            $name = $value["name"];
            echo "<option value=". $name .">". $name ."</option>";
          }
          ?>
            <option value="todas">Todas</option>
          <?php
        }
      ?>
    </select>
    </div>
  </div>
  </div>

<?php 
if($_GET["search"] != null){
  $keyword = $_GET["search"];
  if(strcmp($_GET["search"], "?") != 0){

    $db = new database();
    $stmt = $db->getDataFromSearch($keyword);
    $result = $stmt->fetchAll();
    $number_of_rows = $stmt->rowCount(); 

    if($number_of_rows > 0){   
      echo "<div style=\"overflow-x:auto;\">
      <br><table id=\"pick-product-table\">
      <tr>
        <th>ID Producto</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Inventario</th>
        <th>Tienda</th>
      </tr>";

      foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>".$value["id"]."</td>";
        echo "<td>".$value["descripcion"]."</td>";
        echo "<td>". '$' . number_format($value["precio"],2)." MXN</td>";
        echo "<td>".$value["inventario"]." pieza(s)</td>";
        echo "<td>".$value["tienda"]."</td>";
        echo "</tr>";
      }

      echo "</table></div>";

    } else echo "<div align=\"center\"><br><h1>No se encontraron registros.</h1></div>"; 
  }  
}
?>
</div>
</body>
</html>
