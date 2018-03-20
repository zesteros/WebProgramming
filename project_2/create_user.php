<html>
<head>
</head>
<body>
<!--


insert into user values(1,'Pedro','Moreno','pedrito@correo.com','2000/31/08',477910135);
insert into user values(2,'Joel','Gutierrez','joeli@correo.com','1992/12/08',477128382);
-->
       <form action="insert_user.php" method="post">
            <font face="Arial">Nombre(s)</font>
            <br>
            <input type="text" name="first_name" size="60">
            <br>
            <font face="Arial">Apellido(s)</font>
            <br>
            <input type="text" name="last_name" size="60">
            <br>
             <font face="Arial">Correo</font>
             <br>
            <input type="text" name="email" size="60">
            <br>
            <font face="Arial">Fecha de Nacimiento (YYYY/dd/MM)</font>
            <br>
            <input type="text" name="date_birth" size="60">
            <br>


            <font face="Arial">Teléfono</font>
            <br>
            <input type="text" name="phone" size="60">
            <br>
            <font face="Arial">Usuario</font>
            <br>
            <input type="text" name="user" size="60">
            <br>
             <font face="Arial">Contraseña</font>
             <br>
            <input type="password" name="password" size="60">
           
            <input type="submit" value="Enviar Datos">
            &nbsp;&nbsp;<input type="reset">
            <br>
        </form>
</body>
</html>