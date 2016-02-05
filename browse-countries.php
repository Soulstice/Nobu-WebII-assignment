<?php
require_once('includes/travel-setup.inc.php');

function outputCountriesLinks($dbAdapter) {	
		$gate = new CountryTableGateway($dbAdapter);
		$result = $gate->findCountriesWithImages();
		
		echo '<div class="list-group">';
		foreach ($result as $row)
		{
			echo '<a href="single-country.php?iso='. $row->ISO . '" class="list-group-item">'.$row->CountryName .'</a>';
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
			   <li class="active">Countries</li>
			 </ol>       
			 
			 <div class="jumbotron" id="postJumbo">
			 <h1>Countries</h1>
			 <p>We have images from these countries.</p>
			 <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
			 </div>
			 
			 <?php outputCountriesLinks($dbAdapter); ?>
			 
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?>
 
 </body>
</html>