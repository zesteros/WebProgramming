<html>
<head>
</head>
<body>
<?php
		$host = 'localhost';
		$db   = 'electronica';
		$user = 'root';
		$pass = 'xbox360elite';
		$charset = 'utf8';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		
		$opt = [
    		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    		PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$pdo = new PDO($dsn, $user, $pass, $opt);//create object
		//handle exceptions
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 		

		$stmt = $pdo->query("SELECT * FROM user_pass;");
		$result = $stmt->fetchAll();
		$number_of_rows = $stmt->rowCount(); 
		if($number_of_rows > 0){
			foreach ($result as $key => $value) {
				$id = $value["id_user"];
			}
			$id++;
			$pdo->query("insert into user values("
						. $id. ",'"
						. $_POST["first_name"]. "','"
						. $_POST["last_name"]. "','"
						. $_POST["email"]. "','"
						. $_POST["date_birth"]. "',"
						. $_POST["phone"].
						");");
			$pdo->query("insert into user values("
						. $id. ",'"
						. $_POST["user"]. "','"
						. $_POST["password"].
						"');");
			
		} else echo "No hay registros.";
		
?>
<!--


insert into user values(1,'Pedro','Moreno','pedrito@correo.com','2000/31/08',477910135);
insert into user values(2,'Joel','Gutierrez','joeli@correo.com','1992/12/08',477128382);
-->
</body>
</html>

	