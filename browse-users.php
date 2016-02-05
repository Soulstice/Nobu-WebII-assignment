<?php
require_once('includes/travel-setup.inc.php');

function outputUsers($dbAdapter) {
	$gate = new TravelUserDetailsTableGateway($dbAdapter);
	$result = $gate->findAll();
	echo '<div class="list-group">';
	foreach ($result as $row)
	{
		echo utf8_encode('<a href="single-user.php?id='.$row->UID .'" class="list-group-item">'.$row->FirstName .' '.$row->LastName . '</a></li>');
	}		
	echo '</div>';
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
			   <li class="active">Users</li>
			</ol>       
			 
			<div class="jumbotron" id="postJumbo">
			   <h1>Users</h1>
			   <p>Learn about other users ... or create your own user profile.</p>
			   <p><a href ="#" class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
			</div>  
		 
			<?php outputUsers($dbAdapter);?>
		
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?>
 
 </body>
</html>