<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function outputContent($dbAdapter) {
	$gate = new CountryTableGateway($dbAdapter);
	$result = $gate->findById($_GET['iso']);
		echo utf8_encode('<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li><a href="browse.php">Browse</a></li>
			<li><a href="browse-countries.php">Countries</a></li>
			<li class="active">'.$result->CountryName .'</li>
			</ol>');
				
		echo '<div class="panel panel-default">
			<div class="panel-body">';
			
		echo utf8_encode('<h2>'.$result->CountryName .'</h2>
			<p>Capital: <b>'.$result->Capital .'</b></p>
			<p>Area: <b>'.number_format($result->Area).'</b> sq km.</p>
			<p>Population: <b>'.number_format($result->Population).'</b></p>
			<p>Currency Name: <b>'.$result->CurrencyName .'</b></p>
			<p>'.$result->CountryDescription .'</p>');
				
		echo '</div>
			</div>';
			
	ImagesFrom($result->CountryName, $dbAdapter);
}

function ImagesFrom($countryName, $dbAdapter) {
	$gate = new TravelImageTableGateway($dbAdapter);
	$countryIso = $_GET['iso'];
	$where = 'CountryCodeISO = :countryIso';
	$result = $gate->findBy($where, Array(':countryIso' => $countryIso));

	echo '<div class="panel panel-primary">
		<div class="panel-heading">Images From '.$countryName.'</div>
			<div class="panel-body">';
		
	OutputImages($result);
		
	echo '</div>
		</div>';
}
?>


<!DOCTYPE html>
<?php queryErrorHandlingISO(); ?>
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
			<?php outputContent($dbAdapter); ?>
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?>
 
 </body>
</html>