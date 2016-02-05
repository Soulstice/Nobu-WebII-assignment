<?php
require_once('includes/travel-setup.inc.php');

$favoriteImageList= array();
$favoritePostList = array(); 

if (isset($_SESSION['favoriteImageList'])) {
	$favoriteImageList = $_SESSION['favoriteImageList'];
}
if (isset($_SESSION['favoritePostList'])) {
	$favoritePostList = $_SESSION['favoritePostList'];
}

//function addFavorite(){
if  (isset($_GET['favorite_image_id']) && is_numeric($_GET['favorite_image_id']) && $_GET['favorite_image_id'] >= 0 ){
	
	$gateTravelImageDetails = new TravelImageDetailsTableGateway($dbAdapter);
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	
	$imageID = $_GET['favorite_image_id'];
	
	$path = $gateTravelImage->findById($imageID)->Path;
	$title = $gateTravelImageDetails->findById($imageID)->Title;
	
	$favoriteImage = new FavoriteImage(FavoriteImage::getFieldNames(), false);		
	$favoriteImage->imageID = $imageID;
	$favoriteImage->path = $path;
	$favoriteImage->title = $title;
			
	$favoriteImageList[]= $favoriteImage;
	$_SESSION['favoriteImageList']= $favoriteImageList;
			
	header('Location: single-image.php?id='.$_GET['favorite_image_id']);
	}
elseif (isset($_GET['favorite_post_id']) && is_numeric($_GET['favorite_post_id']) && $_GET['favorite_post_id'] >= 0 ) {
	
	$gateTravelPost = new TravelPostTableGateway($dbAdapter);
	$gateTravelPostImage = new TravelPostImagesTableGateway($dbAdapter);
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	
	$postID = $_GET['favorite_post_id'];
	
	$imageID = $gateTravelPostImage->findById($postID)->ImageID;
	$path = $gateTravelImage->findById($imageID)->Path;
	$title = $gateTravelPost->findById($postID)->Title;
	
	$favoritePost = new FavoritePost(FavoritePost::getFieldNames(), false);		
	$favoritePost->postID = $postID;
	$favoritePost->path = $path;
	$favoritePost->title = $title;
			
	$favoritePostList[]= $favoritePost;
	$_SESSION['favoritePostList']= $favoritePostList;
			
	header('Location: single-post.php?id='.$_GET['favorite_post_id']);
	}
	
else { 
	header("Location: error.php");
	die();
	}

//}




//addFavorite();

?>



