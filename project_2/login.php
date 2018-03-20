<?php
	include 'database.php';
	$user=$_POST['user']; 
	$password=$_POST['password'];

	$user = stripslashes($user);
	$password = stripslashes($password);

	$db = new database();
	$stmt = $db->getUserData($user,$password);
	$result = $stmt->fetchAll();
	$number_of_rows = $stmt->rowCount(); 
	if($number_of_rows == 1){
		session_start();
		foreach ($result as $key => $value) {
			$_SESSION["user_type"] = $value["user_type"];
			$_SESSION["firstname"] = $value["firstname"];
			$_SESSION["lastname"] = $value["lastname"];
		}
		$_SESSION["username"] = $user;
		header("location:home.php");
		$db->pdo = null;
		$db = null;
	} else {
		$db->pdo = null;
		$db = null;
		header("location:index.php?login=failed");
	}
?>