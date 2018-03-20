<?php
class database { 
    
    public $pdo;

	public function __construct() {
		try {
			$host = 'localhost';
			$db   = 'ejemplo1';
			$user = 'prueba';
			$charset = 'utf8';
			$pass = "password";
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$this->pdo = new PDO($dsn, $user, $pass);//create object
			
		} catch (PDOException $e){
			echo 'connection failed: '.$e->getMessage();
		}
	}

	function insertar($id,$nombre,$correo){
		$sql_query = "insert into tabla_ejemplo values('$id','$nombre','$correo');";
		$this->pdo->query($sql_query);
	}

	function consultar(){
		$sql_query = "select * from tabla_ejemplo;";
		$stmt = $this->pdo->query($sql_query);
		return $stmt;
	}

	function actualizar($id,$id_nuevo,$nombre,$correo){
		$sql_query = "update tabla_ejemplo set nombre='$nombre' where id='$id';";
		$this->pdo->query($sql_query);
		$sql_query = "update tabla_ejemplo set correo='$correo' where id='$id';";
		$this->pdo->query($sql_query);
		$sql_query = "update tabla_ejemplo set id='$id_nuevo' where id='$id';";
		$this->pdo->query($sql_query);
	}

	function eliminar($id){
		$sql_query = "delete from tabla_ejemplo where id='$id';";
		$this->pdo->query($sql_query);
	}
}
?>