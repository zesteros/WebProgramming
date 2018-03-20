<?php 
class database { 
    private static $instance = null;
    public $pdo;

	public function __construct() {
		global $pdo;
		try {
			$host = 'localhost';
			$db   = 'electronica';
			$user = 'kualimecatronica';
			$charset = 'utf8';
			$options = ['cost' => 11];
		// Get the password from post
			$pass = "circuitointegrado";
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
			];
			$this->pdo = new PDO($dsn, $user, $pass, $opt);//create object
			//handle exceptions
			$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch (PDOException $e){
				echo 'connection failed: '.$e->getMessage();
		}
	}


	function getUserData($user, $password){

		$table_name_1 = 'user_session';
		$table_name_2 = 'user';
			// To protect MySQL injection
		$user = stripslashes($user);
		$password = stripslashes($password);

		$sql_query = "SELECT user_session.user_type, user.firstname, user.lastname, user_session.username, user_session.password 
		from ". $table_name_1. " inner join ". $table_name_2. " on user_session.id_user = user.id_user 
		WHERE username='". $user. "' and password='". $password. "';";
		$stmt = $this->pdo->query($sql_query);
		return $stmt;
	}

	function getDataFromSearch($keyword){

		$table_name = 'products';
			// To protect MySQL injection
		$keyword = stripslashes($keyword);

		$sql_query = "select products.id_product as id, products.description as descripcion, products.price_to_public as precio, stock.stock as inventario, store.name as tienda
		from products join stock on products.id_product = stock.id_product inner join store on stock.id_store = store.id_store
		where products.description like '%". $keyword. "%';";
		$stmt = $this->pdo->query($sql_query);
		return $stmt;
	}


	function getStores(){
		$table_name = 'store';
		$sql_query = "select id_store, name from store;";
		$stmt = $this->pdo->query($sql_query);
		return $stmt;
	}
} 
?>
<?php
function showSearchItems($onclick_method){
  ?>

  <?php
  }
  ?>