<?php
require_once('includes/travel-setup.inc.php');

function outputPostRows($dbAdapter) {
	$gateTravelPost = new TravelPostTableGateway($dbAdapter);
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	$gateTravelUserDetails = new TravelUserDetailsTableGateway($dbAdapter);
	$gateTravelPostImage = new TravelPostImagesTableGateway($dbAdapter);
	
	$result = $gateTravelPost->findAll();
		
	foreach ($result as $row)
	{
		$postId = $row->PostID;
		$userId = $row->UID;
		$imageId = $gateTravelPostImage->findById($postId)->ImageID;
		$thumb = $gateTravelImage->findById($imageId)->Path;
		$title = $row->Title;
		$firstName = $gateTravelUserDetails->findById($userId)->FirstName;
		$lastName = $gateTravelUserDetails->findById($userId)->LastName;
		$userName = utf8_encode($firstName . $lastName);
		$excerpt = (substr($row->Message,0,200)."...");
		$date = substr($row->PostTime,0,10);

		echo utf8_encode('<div class="row">
		               <div class="col-md-2">
								<a href="single-image.php?id='.$imageId.'" class="">
								<img src="travel-images/square-medium/'.$thumb.'" alt="'.$title.'" class="img-thumbnail"/>
								</a>
		               </div>
		              <div class="col-md-10">
		                  <h2>'.$title.'</h2>
		                  <div class="details">
		                    Posted by <a href="single-user.php?id='. $userId. '" class="">'. $userName. '</a>
		                    <span class="pull-right">'. $date.'</span>
		                  </div>
		                  <p class="excerpt">'.
		                  $excerpt.
		                  '</p>
						  <p><a href="single-post.php?id='. $postId. '" class="btn btn-primary btn-sm">Read more</a></p>
		               </div>
		           </div>
		           <hr/>');
		}
}

?>


<!DOCTYPE html>
<html lang="en">
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
			<ol class="breadcrumb">
			   <li><a href="index.php">Home</a></li>
			   <li><a href="browse.php">Browse</a></li>
			   <li class="active">Posts</li>
			</ol>       
			 
			<div class="jumbotron" id="postJumbo">
			   <h1>Posts</h1>
			   <p>Read other travellers' posts ... or create your own.</p>
			   <p><a href ="#" class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
			</div>  
		 
			<div class="postlist">
			<?php outputPostRows($dbAdapter); ?>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?>
 
 </body>
</html>