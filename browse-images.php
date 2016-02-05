<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function filterCity($dbAdapter) {
	$gate = new CityTableGateway($dbAdapter);
	$result = $gate->findCitiesWithImages();
	foreach ($result as $row)
	{
		echo '<option value="'.$row->GeoNameID .'">';
		echo $row->AsciiName;
		echo '</option>';
	}
}

function filterCountry($dbAdapter) {
	$gate = new CountryTableGateway($dbAdapter);
	$result = $gate->findCountriesWithImages();
	foreach ($result as $row)
	{
		echo '<option value="'.$row->ISO .'">';
		echo $row->CountryName;
		echo '</option>';
	}
}

function displayImages($dbAdapter) {
	$gate = new TravelImageTableGateway($dbAdapter);
	
	if (isset($_GET['go'])){
	$search = $_GET['go'];
	/* $result = $gate->findBySearch($search); */
	$where = "Title LIKE :searched1 OR Description LIKE :searched2";
	$result = $gate->findBy($where, Array(':searched1' => "%" . $search . "%", ':searched2' => "%" . $search . "%"));
	}
	
	//Both city and coutry code are set
	elseif (isset($_GET['country']) && isset($_GET['city']) && $_GET['country'] != 'ZZZ' && $_GET['city'] != '0') {
	$cityIso = $_GET['city'];
	$countryIso = $_GET['country'];
	$where = 'CountryCodeISO = :countryIso AND CityCode = :cityIso';
	$result = $gate->findBy($where, Array(':countryIso' => $countryIso, ':cityIso' => $cityIso));
	}
				
	//country is set, city is not set
	elseif (isset($_GET['city']) && ($_GET['city'] == '0') && isset($_GET['country']) && $_GET['country'] != 'ZZZ') 
	{
	$countryIso = $_GET['country'];
	$where = 'CountryCodeISO = :countryIso';
	$result = $gate->findBy($where, Array(':countryIso' => $countryIso));
	}
		
	//city is set, country is not set
	elseif (isset($_GET['city']) && ($_GET['country'] == 'ZZZ' && $_GET['city'] != '0')) 
	{
	$cityIso = $_GET['city'];
	$where = 'CityCode = :cityIso';
	$result = $gate->findBy($where, Array(':cityIso' => $cityIso));
	}
				
	//both country and city code are not set	
	else {
	$result = $gate->findAll();
	}	
	
	if (isset($_GET['go']) && empty($result)){echo "Search returned no results.";}
	else{
	OutputImages($result); // called from functions.php 
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'includes/travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="index.php">Home</a></li>
           <li><a href="browse.php">Browse</a></li>
           <li class="active">Images</li>
         </ol>          
    
         <div class="well well-sm">
            <form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="city">
                  <option value="0">Filter by City</option>
					<?php filterCity($dbAdapter); ?>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="country">
                  <option value="ZZZ">Filter by Country</option>
					<?php filterCountry($dbAdapter); ?>
                </select>
              </div>  
              <button type="submit" class="btn btn-primary">Filter</button>
            </form>         
         </div>      <!-- end filter well -->
         
         <div class="well">
            <div class="row">
                <!-- display image thumbnails code here -->
				<?php displayImages($dbAdapter); ?>
            </div>
         </div>   <!-- end images well -->

      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
<?php include 'includes/javascript.php'; ?>   
<?php $dbAdapter->closeConnection(); ?>
</body>
</html>