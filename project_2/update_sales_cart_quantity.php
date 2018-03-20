<?php
	session_start();

	$sales_cart = $_SESSION['sales_cart'];

	$id = $_REQUEST['id'];
	$quantity = $_REQUEST['quantity'];

	for ($i=0; $i < count($sales_cart); $i++) { 
		if($sales_cart[$i]['id'] == $id){
			$sales_cart[$i]['quantity'] = $quantity;
			break;
		}
	}
	$_SESSION['sales_cart'] = $sales_cart;

?>