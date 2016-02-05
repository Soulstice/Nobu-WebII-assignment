<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function outputPost($dbAdapter) {
		
		$gateTravelPost = new TravelPostTableGateway($dbAdapter);
		
		$result = $gateTravelPost->findById($_GET['id']);
		
		echo utf8_encode('<ol class="breadcrumb">
			   <li><a href="index.php">Home</a></li>
			   <li><a href="browse.php">Browse</a></li>
			   <li><a href="browse-posts.php">Posts</a></li>
			   <li class="active">'.utf8_encode($result->Title) .'</li>
			</ol>');
		
		echo '<h1>'.utf8_encode($result->Title).'</h1>';
		
		echo '<div class="row">
				<div class="col-md-9">';
		
		echo '<div class="panel panel-default">
			<div class="panel-body">';
			
		echo utf8_encode($result->Message);	
			
		echo '</div>
			</div>';
			
		echo '<div class="panel panel-primary">
			<div class="panel-heading">Images for Post</div>
			<div class="panel-body">';
				
			outputThumbnail($dbAdapter);
		echo '</div>
			</div>
			</div>';
		
		
		echo '<div class="col-md-3">';
			outputRightColumn($result->UID, $dbAdapter);
		echo	'</div>';
		
}

function outputThumbnail($dbAdapter) {
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
		
	$result = $gateTravelImage->findForPost($_GET['id']);

	OutputImages($result);
}

function checkDuplicatePost() {
	if (checkDuplicateItem('favoritePostList', 'postID') == true) {
	$script = '<p>Added to Favorites</p>';
	}
	else {
	$script = '<p><a href="addToFavoritePost.php?favorite_post_id='.$_GET['id'].'"<button type="button" class="btn btn-info">Add to Favorites</button></a></p>';
	}
	return $script;
}

function SocialPanel() {
	echo '<div class="panel panel-success">
			<div class="panel-heading">Social</div>
			<div class="panel-body">'.
			checkDuplicatePost().'
			<p><a href="browse-favorites.php"><button type="button" class="btn btn-success">View Favorites</button></a></p>
			</div>
		</div>';
}

function outputRightColumn($UID, $dbAdapter) {

		PostByPanel($UID, $dbAdapter);
		PostByThisUserPanel($UID, $dbAdapter);				
		SocialPanel();
		
}

function PostByPanel($UID, $dbAdapter) {
	$gateTravelUserDetails = new TravelUserDetailsTableGateway($dbAdapter);
	$result = $gateTravelUserDetails->findById($UID);
	
	echo	'<div class="panel panel-info">
				<div class="panel-heading">Posted By</div>
				<div class="panel-body">
					<a href="single-user.php?id='.$UID.'">'.utf8_encode($result->FirstName).' '.utf8_encode($result->LastName).'</a>';
	
}

function PostByThisUserPanel($UID, $dbAdapter){
	$gateTravelPost = new TravelPostTableGateway($dbAdapter);
	$resultTravelPost = $gateTravelPost->findForPosts($UID);
	
	echo '<hr>
			<p><i>Posts By This User</i></p>';

	foreach ($resultTravelPost as $row)
	{		
		echo '<p><a href="single-post.php?id='.$row->PostID .'">'.$row->Title .'</a></p>';
	}	
	echo '</div>
		</div>';
}

?>


<!DOCTYPE html>

<html lang="en">
<?php queryErrorHandlingID(); ?>
<head>
	<title>Share your Travels Assignment 1</title>
	<?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php include 'includes/travel-left-rail.inc.php'; ?>
		</div>
		
		<div class="col-md-9">  <!-- start main content column -->  
				<?php outputPost($dbAdapter); ?>
			</div>
		
		</div>
	</div>


<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>  
<?php $dbAdapter->closeConnection(); ?> 
 
 </body>
</html>