<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function outputUserInfo($dbAdapter) {
	$gateTravelUserDetails = new TravelUserDetailsTableGateway($dbAdapter);
	$result = $gateTravelUserDetails->findById($_GET['id']);
	
	$name = $result->FirstName . ' '. $result->LastName;
	
	echo utf8_encode('<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li><a href="browse.php">Browse</a></li>
		<li><a href="browse-users.php">Users</a></li>
		<li class="active">'.$name.'</li>
		</ol>');
			
		echo '<div class="panel panel-default">
			<div class="panel-body">';
		
		echo utf8_encode('<h2>'.$name.'</h2>
			<p>Address: <b>'.$result->Address .'</b></p>
			<p>City, Country: <b>'.$result->City .', '.$result->Country .'</b></p>
			<p>Email: <b>'.$result->Email .'</b></p>');
			
		echo	'</div>
			</div>';
		echo utf8_encode('<div class="panel panel-primary">
			<div class="panel-heading">Images From '.$name.'</div>
			<div class="panel-body">');
		
		outputUserImages($dbAdapter);
		
		echo '</div>
			</div>';
}

function outputUserImages($dbAdapter) {
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	$result = $gateTravelImage->findForUser($_GET['id']);
		
	OutputImages($result);
}


?>


<!DOCTYPE html>
<?php queryErrorHandlingID(); ?>
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
		
			<?php outputUserInfo($dbAdapter);?>
		
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?> 
 
 </body>
</html>