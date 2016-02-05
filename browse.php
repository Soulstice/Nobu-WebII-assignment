<?php
require_once('includes/travel-setup.inc.php');
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
			   <li class="active">Browse</li>
			</ol>       
			 
			<div class="jumbotron" id="postJumbo">
			   <h1>Browse</h1>
			   <p>Examine lists of these...</p>
			   <p><a href ="#" class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
			</div>  
		 
			<div class="list-group">
			  <a href="browse-countries.php" class="list-group-item">Countries</a>
			  <a href="browse-images.php" class="list-group-item">Images</a>
			  <a href="browse-posts.php" class="list-group-item">Posts</a>
			  <a href="browse-users.php" class="list-group-item">Users</a>
			  <a href="statistics.php" class="list-group-item">Stats</a>
			  <a href="browse-favorites.php" class="list-group-item">Favorites</a>
			  <a href="browse-cart.php" class="list-group-item">Cart</a>
			</div>
		
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
 
 </body>
</html>