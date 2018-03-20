<!--

    TODO:
        *Mejorar apariencia de botones de sesión-liato
		*Dar funcionalidad a recuerdame (mantener sesión una vez cerrado el navegador)
        *Añadir menú de administración de usuarios(agregar usuarios, privilegios, contraseña, foto de perfil)
        *Añadir imagen de perfil y mostrar en inicio en menu de usuarios
        *Dar funcionalidad a botones de requerimientos
        *Buscar manera de conectar plotty con php/javascript/html/mysql/css

-->

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/index-style-sheet.css">
	<title>Inicio</title>
</head>

<body>
    <div id="principal" align="center">
        <form action="login.php" method="post">
            <img id="imgcontainer" src="images/kuali.png" height="250" width="250">
            <h2>Bienvenido</h2>
            <label for="user">Usuario</label>
            <br>
            <input type="text" placeholder="Ingresa tu usuario" id="user" name="user"/>
            <br><br>
            <label for="password">Contrase&#241;a</label>
            <br>
            <input type="password" placeholder="Ingresa tu contrase&#241;a" id="password" name="password"/>
            <br><br>
            <?php
                if (isset($_GET["login"]) && $_GET["login"] == 'failed') {
                    echo "<label><font color=red>Usuario o contrase&#241;a incorrecta</font></label>";
                }
            ?>
            <br><br>
            <input type="submit" value="Aceptar" id="aceptar"/>
            <br><br><br>
            <input type="checkbox" checked="checked"> Recu&eacuterdame
            </form>
    </div>
</body>
</html>