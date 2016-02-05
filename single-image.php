<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function outputImageInfo($dbAdapter) {

	$gateTravelImageDetails = new TravelImageDetailsTableGateway($dbAdapter);
	$gateTravelImage = new TravelImageTableGateway($dbAdapter);
	$result = $gateTravelImageDetails->findById($_GET['id']);
	
	$imageId = $result->ImageID;
	$path = $gateTravelImage->findById($imageId)->Path;
	$UID = $gateTravelImage->findById($imageId)->UID;
	
	$latitude = $result->Latitude;
	$longitude = $result->Longitude;
	$location = array("latitude"=>$latitude, "longitude"=>$longitude);

	echo utf8_encode('<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li><a href="browse.php">Browse</a></li>
			<li><a href="browse-images.php">Images</a></li>
			<li class="active">'.utf8_encode($result->Title).'</li>
		</ol>');
		
	singleImagePanel($result->Title, $path, $result->Description);
			
	generateMapPanel($location);
			
		echo '<div class="row">
			<div class="col-md-3">';
			imageByPanel($UID, $dbAdapter);
			echo '</div><div class="col-md-3">';
			ImageDetailsPanel($result->CityCode, $result->CountryCodeISO, $dbAdapter);
			echo '</div><div class="col-md-3">';
			socialPanel();
		echo '</div><div class="col-md-3">';
			cartpanel(); 
		echo	'</div></div>';
}

function generateMapPanel($location) {
	echo '<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				<div class="panel-heading">Image Location</div>	
					<div class="panel-body" align="center">
						<div class="mapContainer">
							<div id="map"></div>
							<input type="button" class="btn btn-default" value="Back to Location" onclick="toMarker()" />
							<div id="map-info">
								<hr>
								<p>Latitude: <span id="lat">'.$location["latitude"].'</span></p>
								<p>Longitude: <span id="lon">'.$location["longitude"].'</span></p>
							</div>	
						</div>	
					</div>
				</div>	
			</div>
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
				<?php outputImageInfo($dbAdapter); ?>
		</div>
		
	</div>
</div>


<?php include 'includes/travel-footer.inc.php'; ?>   s
<?php include 'includes/javascript.php'; ?>  
<?php $dbAdapter->closeConnection(); ?>
 </body>
</html>