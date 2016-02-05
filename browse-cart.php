<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

//sets the shipping session it it isnt set, this allows us to keep page state on the shipping options.
if (!isset($_SESSION["shipping"]))
{
	$_SESSION["shipping"] = "standard";
}

//when user removes entire cart it will unset all cart related sessions.
if(isset($_GET["cart"]) && $_GET["cart"]=="clear")
{
	unset($_SESSION["Cart"]);
	unset($_SESSION["shipping"]);
}

//outputs the SELECT options for size, stock, and frame.
function outputOptions($object, $type){
	if ($type == "size")
	{
		$array = array("5x7" => "5x7","8x10" => "8x10", "11x14" => "11x14", "12x18" => "12x18");
	}elseif($type == "stock")
	{
		$array = array ("Matte" => "Matte", "Glossy"=>"Glossy", "Canvas"=>"Canvas");
	}elseif($type =="frame"){
		$array = array ("none"=>"none", "Blond Maple"=>"Blond Maple", "Expresso Walnut"=>"Expresso Walnut", "Gold Accent"=>"Gold Accent", "Silver Metal"=>"Silver Metal");
	}else {}
	
	foreach($array as $value)
	{
		if ($value == $object->__get($type))
		{
			echo '<option selected = "selected" value = "'.$value.'"> '.$value.'</option>';
		}else{
			echo '<option value = "'.$value.'"> '.$value.'</option>';
		}
	}
}


//generates the Cart markup.
function generateCartList($dbAdapter) {
		if (!isset($_SESSION["Cart"])) {
			echo '<h1> No Items in your Cart. </h1>';
		}
		else {			
			echo '<table class="table">
				<tr style="border-bottom:2px solid #596a7b" width="100%">
					<th>Image</th>
					<th>Title</th>
					<th>Size</th>
					<th>Stock</th>
					<th>Quantity</th>
					<th>Frame</th>
					<th>Cost</th>
				</tr>';
				//outputs the cart items from the Session.
				$sub = displayCartItems($dbAdapter);
				//outputs subtotal.
				$sub = number_format((float)$sub, 2, '.', '');
			echo '</table>';
			echo '<div class = "pull-right">';
					echo '<form action = "browse-cart.php?cart=clear" method="GET">';
						echo '<input type = "hidden" name = "cart" value = "clear">';
						echo '<button type="submit" class="btn btn-primary">Remove Entire Cart</button>';
					echo "</form>";
				echo '</div><br>';
			echo '<hr>';
				
			echo '<h3 class = "pull-right">SubTotal</h3>';
			echo "<div>";
				echo "<h2>Shipping Options</h2><br>";
				echo '<div id = "sub1" class = "pull-right">$'.$sub.'</div>';
				echo '<form action = "browse-cart.php" method="GET">';
				// calls shipping function to calculate shipping cost.
				$shipCost = shipping($sub);
				echo '</form>';
			echo "</div>";
			echo "<hr>";
			//outputs total cost.
			echo "<div class = 'pull-right'><h3>Total</h3><div id = 'total'>$". calcTotal($sub, $shipCost) . "</div></div><br>";	
				echo '<form action = "index.php" method = "POST">';
				echo '<button type = "submit" class="btn btn-primary">Continue Shopping</button>';
				echo '</form>';
				echo '<br><button class="btn btn-primary">Check Out</button>';
			echo "</div>";
		}
}

//calculates the total cost of cart including the shipping.
function calcTotal($sub, $ship)
{
		$total = $sub + $ship;
		$total = number_format((float)$total, 2, '.', '');
		return $total;
}

//contains the markup for the shipping options as well as the logic.
function shipping($sub)
{
$r1 = "";
$r2 = "";

if($_SESSION["shipping"]=="standard")
{
	$r1 = "checked";
}else{
	$r2 = "checked";
}
	$shipping;
		echo '<input id = "r1" type="radio" name="option" value="standard" '. $r1 .' > Standard Shipping<br>';
		echo '<input id = "r2" type="radio" name="option" value="express"  '. $r2 .'> Express Shipping';
	echo '<h3 class = "pull-right">Shipping Cost</h3><br>';
	
	//if else that calculates the shipping cost based on it being standard or express.
	if(isset($_SESSION["shipping"]) && $_SESSION['shipping']=="express")
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
	}else
	{
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
	//outptus shipping cost.
	echo "<br><br><br><div id = 'shipCost' class = 'pull-right'>$".number_format((float)$shipping, 2, '.', ''). "</div>";
	return $shipping;
}

//counts the amount of frames in the cart for the shipping cost.
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

//outputs the cart items from the Session.
function displayCartItems($dbAdapter){
	
			$gateTravelImageDetails = new TravelImageDetailsTableGateway($dbAdapter);
			$gateTravelImage = new TravelImageTableGateway($dbAdapter);
			$sub = 0;
			// runs through each item in the cart giving a row in the table.
	foreach ($_SESSION["Cart"] as $object) 
			{

				$id = $object->__get("imageID");
				$serial = $object->__get("serial");
				$result = $gateTravelImageDetails->findById($id);
				$title = $result->Title;
				$path = $gateTravelImage->findById($id)->Path;
				$cost = number_format((float)$object->calcCost(), 2, '.', '');
				$sub = $sub+$cost;
				
				echo '<form action = "addToCart.php?serial='.$serial.'&amp;modify=update" method = "POST">';
					echo '<tr id = "'.$serial.'" style="border-bottom:2px solid #596a7b ">';
					echo '<td><img src="travel-images/square-small/'.$path.'"></td>';
					echo '<td><a href="single-image.php?id='.$id.'">'.$title.'</a></td>';
					echo '<td>
							<select name = "size"> ';
							outputOptions($object, "size");
					echo	'</select>
						</td>';
					echo '<td>
							<select name = "paper">';
								outputOptions($object, "stock");
					echo '	</select></td>';
					echo '<td><input type = "number" name = "quantity" size = 2 min = "1" max = "50" value = '.$object->__get("quantity").' required></td>';
					echo '<td>
							<select name = "frame" maxlength = 15>';
								outputOptions($object, "frame");
					echo '	</select></td>';
					echo '<td id = "'.$serial.'1">$'. $cost .'';
					echo '<td>';
					echo '<td> <button class = "glyphicon glyphicon-remove" id = "remove"/>';
					echo '</td>';
					echo "</tr>";
				echo '</form>';
			
			}
		return $sub;
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Share your Travels Assignment 1</title>
	<?php include 'includes/travel-head.inc.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="includes/js/CartJS.js"></script>
	
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php include 'includes/travel-left-rail.inc.php'; ?>
		</div>
		
		<div class="col-md-9"><!-- start main content column -->
			<ol class="breadcrumb">
			   <li><a href="index.php">Home</a></li>
			   <li><a href="browse.php">Browse</a></li>
			   <li class="active">Cart</li>
			</ol>
			<div class="well">
				<?php generateCartList($dbAdapter); ?>
			</div>
		</div>
		
		</div>
	</div>


<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>  
<?php $dbAdapter->closeConnection(); ?>
 
 </body>
</html>