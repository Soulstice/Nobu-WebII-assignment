<?php
require_once('includes/travel-setup.inc.php');

if (!isset($_SESSION['favoritePostList'])) {
	$_SESSION['favoritePostList'] = [];
}

if (isset($_GET['favorite_post_id']) && is_numeric($_GET['favorite_post_id']) && $_GET['favorite_post_id'] >= 0 ) {
	
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
			
	$_SESSION['favoritePostList'][]= $favoritePost;
			
	header('Location: single-post.php?id='.$_GET['favorite_post_id']);
	}
	
else { 
	header("Location: error.php");
	die();
	}

?>



