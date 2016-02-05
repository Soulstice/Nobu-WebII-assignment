<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

if (isset($_GET['delete-all-image'])) {
	unset($_SESSION['favoriteImageList']);
}
elseif (isset($_GET['delete-all-post'])) {
	unset($_SESSION['favoritePostList']);
}
elseif (isset($_GET['delete-image'])) {
	removeSingleItem('favoriteImageList', $_GET['delete-image'], 'imageID'); 
}
elseif (isset($_GET['delete-post'])) {
	removeSingleItem('favoritePostList', $_GET['delete-post'], 'postID'); 
}

header('Location: browse-favorites.php');

?>