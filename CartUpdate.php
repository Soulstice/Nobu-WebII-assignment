<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

//This file takes in data from the users javascript on the cart page, updates the session and returns data back to the user as a JSON object.
header('Content-type: application/json');
	

	$serArr = array();
	
	//allows shipping total to be changed regardless if the shipping option was changed or not.
	if(isset($_POST["shipTotal"]) && isset($_POST["subTotal"]) )
	{
		$sub = $_POST["subTotal"];
		$shipping = $_POST["shipTotal"];
	}else {
		$sub = 0;
		$shipping = 0;
	}
	
	//this foreach loop will check the change event for the corresponding object in the session and update the value that was changed.
	foreach($_SESSION["Cart"] as $object)
	{
		if(isset($_POST["serial"]) && $_POST["serial"]==$object->__get("serial"))
		{
			if(isset($_POST["size"]))
			{
				$object->__set("size",$_POST["size"]);
			}
			if(isset($_POST["paper"]))
			{
				$object->__set("stock",$_POST["paper"]);
			}
			if(isset($_POST["frame"]))
			{
				$object->__set("frame",$_POST["frame"]);
			}
			if(isset($_POST["quantity"]))
			{
				$object->__set("quantity",$_POST["quantity"]);
			}	
		}
		$cost = number_format((float)$object->calcCost(), 2, '.', '');
		$sub = $sub+$cost;
		$serArr[$object->__get("serial")] = $cost;
		
		
	}
	
	//the code for updateing the session on the shipping choice as well as the logic for calculated the new shipping price.
	if(isset($_POST["shipping"]))
	{
		$value = $_POST["shipping"];
		$_SESSION["shipping"] = $value;
		$serArr["shipping"] = $value;
		$shipping = 0;
				
				if($value == "express")
				{
					if($sub >=300)
					{
						$shipping = 0;
					}else{
						$frameC = frameCount();
						if ($frameC ==0)
						{
							$shipping = 15;
						}elseif($frameC <=10){
							$shipping = 25;
						}elseif($frameC > 10)
						{
							$shipping = 45;
						}else{}
					}
				}else{
					if($sub >=100)
					{
						$shipping = 0;
					}else{
						$frameC = frameCount();
						if ($frameC ==0)
						{
							$shipping = 5;
						}elseif($frameC <=10){
							$shipping = 15;
						}elseif($frameC > 10)
						{
							$shipping = 30;
						}else{}
					}	
				}
		//adds the new shipping cost to the JSON return object.
		$shipping = number_format((float)$shipping, 2, '.', '');
		$serArr["shipCost"] = $shipping;
	}
	
	if(isset($_POST["remove"]) && $_POST["remove"]=="yes")
	{
		$remove = $_POST["remove"];
		removeSingleItem("Cart", $_POST["serial"], "serial");
		$serArr[$_POST["serial"]] = $_POST["serial"];
	}
	
	//calculates the new total and adds it to the JSON return object.
	$total = $sub + $shipping;
	$total = number_format((float)$total, 2, '.', '');
	$serArr["total"] = $total;
	
	//adds the new subtotal to the JSON return object.
	$sub = number_format($sub, 2, '.', '');
	$serArr["sub"] = $sub;
	
	//returns the JSON object back to the user for an asynchronous  update of the page.
	echo json_encode($serArr);
	
	
	//required for the counting the frames when calculating the shipping cost.
	function frameCount()
{
	$frameCount = 0;
	foreach($_SESSION["Cart"] as $object)
	{
		if($object->__get("frame")=="none")
		{}else{
			$frameCount = $frameCount + $object->__get("quantity");
		}
	}
	return $frameCount;
}
?>

