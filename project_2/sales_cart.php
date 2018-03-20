<?php
	session_start();

	$id = $_REQUEST["id"];
	$desc = $_REQUEST["desc"];
	$price = $_REQUEST["price"];
	$stock = $_REQUEST["stock"];
	$quantity = $_REQUEST["quantity"];

	/*if(!isset($_SESSION['sales_cart_count']))
		$_SESSION['sales_cart_count'] = 0;
	else $_SESSION['sales_cart_count']++;
*/

	//$sales_cart_count = $_SESSION['sales_cart_count'];
	$newSale = //array (
		 	//$sales_cart_count =>
			array(
			'id' => $id,
			'desc' => $desc,
			'price' => $price,
			'stock' => $stock,
			'quantity' => $quantity//)
		);

	$isAlreadyInTable = false;

	if(isset($_SESSION['sales_cart'])){

		$sales_cart = $_SESSION['sales_cart'];

		for ($i=0; $i < count($sales_cart); $i++) { 
			if($sales_cart[$i]['id'] == $id) {
				$isAlreadyInTable = true;
				break;
			}
		}

		if(!$isAlreadyInTable){

			array_push($sales_cart, $newSale);
			$_SESSION['sales_cart'] = $sales_cart;
			$sales_cart = $_SESSION['sales_cart'];

			print_r($sales_cart);

			for ($i=0; $i < count($sales_cart); $i++) { 

				$id = $sales_cart[$i]['id'];
				$desc = $sales_cart[$i]['desc'];
				$price = $sales_cart[$i]['price'];
				$stock = $sales_cart[$i]['stock'];
				$quantity = $sales_cart[$i]['quantity'];
				//print_r($sales_cart[$i]);
				//echo $id."','".$desc."','".$price."','".$stock."','".$quantity;	
			}
		}	
			# code...*/
	} else {
		$_SESSION['sales_cart'] = array();
		array_push($_SESSION['sales_cart'], $newSale);
	}

	echo $id.",".$desc.",".$price. ",". $stock.",".$quantity;
?>