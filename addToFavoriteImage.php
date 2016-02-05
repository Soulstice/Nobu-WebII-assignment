<?php
require_once('includes/travel-setup.inc.php');

if (!isset($_SESSION['favoriteImageList'])) {
	$_SESSION['favoriteImageList'] = [];
}

if (isset($_GET['favorite_image_id']) && is_numeric($_GET['favorite_image_id']) && $_GET['favorite_image_id'] >= 0 ){
	
	$gateTravelImageDetails = new TravelImageDetailsTableGateway($dbAdapter);
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	
	$imageID = $_GET['favorite_image_id'];
	
	$path = $gateTravelImage->findById($imageID)->Path;
	$title = $gateTravelImageDetails->findById($imageID)->Title;
	
	$favoriteImage = new FavoriteImage(FavoriteImage::getFieldNames(), false);		
	$favoriteImage->imageID = $imageID;
	$favoriteImage->path = $path;
	$favoriteImage->title = $title;
			
	$_SESSION['favoriteImageList'][]= $favoriteImage;
			
	header('Location: single-image.php?id='.$_GET['favorite_image_id']);
	}
else { 
	header("Location: error.php");
	die();
	}

?>



