<?php
// function to output images from the database passing image id and path
function OutputImages($result) {
	foreach ($result as $row) {
		echo '<div class="col-md-3">';
		echo '<a href="single-image.php?id='.$row->ImageID .'"><img src="travel-images/square-medium/'.$row->Path .'" class="img-thumbnail"></a>';
		echo '</div>';
	}
}

// function to handle query error for ISO in the url 
function queryErrorHandlingISO() {
	if(empty($_GET['iso']) || is_numeric($_GET['iso']) || strlen($_GET['iso']) !=2 || !ctype_upper($_GET['iso'])){
		header("Location: error.php");
		die();
	}
}

// function to handle query error for ID in the url
function queryErrorHandlingID() {
	if(empty($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0){
		header("Location: error.php");
		die();
	}
}

// function to check duplicate item in the session
// return true if duplicate is found, false otherwise
function checkDuplicateItem($sessionName, $itemID) {
	if (isset($_SESSION[$sessionName])) { 
		foreach ($_SESSION[$sessionName] as $key => $item) {
			if($item->__get($itemID) == $_GET['id']) {
				return TRUE;
				break;
			}
		}
	}
	return false;
}

// function to remove single item found by comparison of fed value and item id in session
function removeSingleItem ($sessionName, $value, $id) {
	foreach ($_SESSION[$sessionName] as $key => $item) {
		if($item->__get($id) == $value) {
			if (count($_SESSION[$sessionName]) <= 1) { //if there is only one item left, unset entire session itself
				unset($_SESSION[$sessionName]);
			}
			unset($_SESSION[$sessionName][$key]);
			break;
		}
	}
}

function CartMarkUp(){
	echo "Size:";
	echo 	cartSize().'<br>';
	echo 	"Quantity:";
	echo	cartQuant().'<br>';
	echo 	"Stock:";
	echo 	cartPaper().'<br>';
	echo 	"Frame:";
	echo 	cartFrame();
	echo '<p><button type="submit" class="btn btn-warning">Add to Cart</button></p>';
	

}
function cartSize()
{
	echo'<select name = "size"> 
				<option value = "8x10">8x10</option>
				<option value = "5x7">5x7</option>
				<option value = "11x14">11x14</option>
				<option value = "12x18">12x18</option>
			</select>
	';
}

function cartPaper()
{
	echo '<select name = "paper">
				<option value = "Matte">Matte</option>
				<option value = "Glossy">Glossy</option>
				<option value = "Canvas">Canvas</option>
			</select>';
}
function cartQuant()
{
	echo '<input type = "number" name = "quantity" size = 2 min = "1" max = "50" value = 1 required>';
}

function cartFrame()
{
	echo '<select name = "frame" maxlength = 15>
				<option value = "none">No Frame</option>
				<option value = "Blond Maple">Blond Maple</option>
				<option value = "Expresso Walnut">Expresso Walnut</option>
				<option value = "Gold Accent">Gold Accent</option>
				<option value = "Silver Metal">Silver Metal</option>
			</select>';
}

function singleImagePanel($title, $path, $description) {
		echo '<h1>'.utf8_encode($title).'</h1>';
		
		echo '<div class="row">
				<div class="col-md-12">';
		
		echo '<div class="panel panel-default">
			<div class="panel-body" align=center>';
		
		echo '<img src="travel-images/medium/'.$path.'" class="" data-toggle="modal" data-target=".bs-example-modal-lg">
		
			<div id="myModal" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg center" role="document">
					 <div class="modal-content">
						<div class="modal-body">
							<img src="travel-images/large/'.$path.'" class="img-responsive largeImage center" >
						</div>
					 </div>
				</div>
			</div>
			';
				
		echo '<p>'.$description .'</p>';
			
		echo '</div>
			</div>
			</div>
			</div>';
}

function checkDuplicateImage() {
	if (checkDuplicateItem('favoriteImageList', 'imageID') == true) {
	$script = '<p>Added to Favorites</p>';
	}
	else {
	$script = '<p><a href="addToFavoriteImage.php?favorite_image_id='.$_GET['id'].'"<button type="button" class="btn btn-info">Add to Favorites</button></a></p>';
	}
	return $script;
}

function imageByPanel($uid, $dbAdapter) {
	$gateTravelUserDetails = new TravelUserDetailsTableGateway($dbAdapter);
	$result = $gateTravelUserDetails->findById($uid);
	
	echo	'<div class="panel panel-info">
			<div class="panel-heading">Image By</div>
			<div class="panel-body">';
			
	echo utf8_encode('<a href="single-user.php?id='.$result->UID .'">'.$result->FirstName .' '.$result->LastName .'</a>');	
	
	echo '</div>
		</div>';
}

function ImageDetailsPanel($cityCode, $countryCode, $dbAdapter) {
	$gateCountry = new CountryTableGateway($dbAdapter);
	$gateCity = new CityTableGateway($dbAdapter);
	
	$cityName = $gateCity->findById($cityCode)->AsciiName;
	$countryName = $gateCountry->findById($countryCode)->CountryName;
	$countryCodeISO = $gateCountry->findById($countryCode)->CountryCodeISO;
	
	echo '<div class="panel panel-info">
		<div class="panel-heading">Image Details</div>
		<div class="panel-body">';		
		
		echo utf8_encode('<p>'.$cityName.', <a href="single-country.php?iso='.$countryCode.'">'.$countryName.'</a></p>');
	
	echo '</div>
		</div>';		
}

function socialPanel() {
	echo '<div class="panel panel-success">
		<div class="panel-heading">Social</div>
		<div class="panel-body">'.
			checkDuplicateImage().'
			<p><a href="browse-favorites.php"><button type="button" class="btn btn-success">View Favorites</button></a></p>
		</div>
	</div>';
}



function cartpanel(){
	echo '<div class="panel panel-danger">
		<div class="panel-heading">Purchase</div>
		<div class="panel-body">
		<form action = "addToCart.php?id='.$_GET['id'].'" method = "POST">
			';
			CartMarkUp();
	echo '	
			</form>
		</div>
	</div>';
}

?>