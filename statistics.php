<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');
include ('StatsFunctions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
 window.addEventListener('load', function(){drawChart(); drawRegionsMap();});

	
     google.load("visualization", "1", {packages:["corechart"]});

      google.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo viewsLastMonth($dbAdapter); ?>);

        var options = {
          title: 'Previous Months Views',
          hAxis: {title: 'Day of Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('area_chart_div'));
        chart.draw(data, options);
      } 
	  

      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable(<?php echo viewsFirstSixMonthsByYear($dbAdapter); ?>);

        var options = {
		colorAxis: {colors: ['#99ff99', '#072926']}
		};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1.1", {packages:["bar"]});
      
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
        <?php if( isset($_POST['C1']) && isset($_POST['C2']) && isset($_POST['C3'] )){  echo getColumnChartResults($dbAdapter, $_POST['C1'], $_POST['C2'], $_POST['C3']);} ?> 
   
		]);

        var options = {
          chart: {
            title: 'Site Views',
            subtitle: '2014-2016',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }

 
	  
	function checkSelections() {
	var C1 = document.getElementById("C1").value;
	var C2 = document.getElementById("C2").value;
	var C3 = document.getElementById("C3").value;
	if(C1 != "default" && C2 != "default" && C3 != "default" && C1 != C2 && C1 != C3 && C2 != C3){document.getElementById("chart-submit").disabled = false;}
	else {document.getElementById("chart-submit").disabled = true;}
	} 
    </script>


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
           <li class="active">Statistics</li>
         </ol>  
 
	<div class="well"> <!--Start Area Chart -->
			<div id="area_chart_div" style="width: 100%; height: 500px;"></div> 
	</div> <!--End Area Chart -->
	
<div class="well"> <!--Start Geo Chart -->
	<h4>Total Views: First Six Months of Current Year</h4>
	<div id="regions_div" style="width: 100%; height: 500px;"></div>

</div> <!--End Geo Chart -->
	
	<div class="well"> <!--Start Column Chart -->
		<form method="post" action="statistics.php" id="chart-form">
			<?php getDropDownCountries($dbAdapter); ?>
			<input value="Chart It" id="chart-submit" type="submit" disabled>
		</form>
		
		<?php
		if( isset($_POST['C1']) && isset($_POST['C2']) && isset($_POST['C3'] )) 
		{echo "<script>google.setOnLoadCallback(drawChart2);</script>";}
		?>
		    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

		
	</div> <!--End Column Chart -->
 
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