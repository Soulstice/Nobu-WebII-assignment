<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');


function getIndex($array, $value){
	$itemIndex = -1;
	$index = 0;
	
	foreach($array as $check){
		if ($check->__get("serial")==$value)
		{
			$itemIndex = $index;
		}
		$index++;
	}
	return $itemIndex;
}



if (!isset($_SESSION["Cart"]))
{
	$_SESSION["Cart"] = [];
}

if(isset($_GET['modify']) && $_GET['modify']=="update")
{
	//removes items from cart
	if ( $_POST['remove']=="yes")
	{
				removeSingleItem("Cart", $_GET["serial"], "serial");
	}else{
		//updates cart item selected
		foreach ($_SESSION["Cart"] as $object){
			if($_GET["serial"]==$object->__get("serial"))
			{
				$object->__set("size",$_POST["size"]);
				$object->__set("stock",$_POST["paper"]);
				$object->__set("frame",$_POST["frame"]);
				$object->__set("quantity",$_POST["quantity"]);
				
			}
		}
	}
	header("Location: browse-cart.php");
}
else{
	
	// adds a new item to the cart.
	if  (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] >= 0 )
	{
		$serial = rand(000000000,999999999);
		
		$cart = new cartItem(cartItem::getFieldNames(), false);
		$cart->__set("imageID",$_GET["id"]);
		$cart->__set("size",$_POST["size"]);
		$cart->__set("stock",$_POST["paper"]);
		$cart->__set("frame",$_POST["frame"]);
		$cart->__set("quantity",$_POST["quantity"]);
		$cart->__set("serial",$serial);
		
		
		
		array_push($_SESSION["Cart"], $cart);
		
		header('Location: browse-cart.php');
	}
}

?>