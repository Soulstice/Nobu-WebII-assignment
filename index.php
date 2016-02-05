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
	         <div class="panel panel-default">
           <div class="panel-heading">Search</div>
           <div class="panel-body">
             <form method="get" action="includes/search.php">
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="search ..." name="go">
                  <span class="input-group-btn">
                    <button class="btn btn-warning"><span class="glyphicon glyphicon-search"></span>          
                    </button>
                  </span>
               </div>  
             </form>
           </div>
         </div> 
	</div>
	
		<div class="col-md-9">  <!-- start main content column -->
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="travel-images/large/8710247776.jpg" alt="Dusk on Imerovigli (Santorini)" class="center">
      <div class="carousel-caption">
        <h3>Dusk on Imerovigli (Santorini)</h3>
        <p>Looking towards Imerovigli, a village devoted to the appreciation of the sunset!</p>
		<a class="btn btn-primary btn-lg" href="single-image.php?id=77" role="button">Learn more</a>
      </div>
    </div>

    <div class="item">
      <img src="travel-images/large/8710289254.jpg" alt="Looking towards Fira" class="center">
      <div class="carousel-caption">
        <h3>Looking towards Fira</h3>
        <p>At the top of the Lycabettus Hill</p>
		<a class="btn btn-primary btn-lg" href="single-image.php?id=78" role="button">Learn more</a>
      </div>
    </div>

    <div class="item">
      <img src="travel-images/large/8710320515.jpg" alt="Ekklisia Agii Isidori church" class="center">
      <div class="carousel-caption">
        <h3>Ekklisia Agii Isidori church</h3>
        <p>Photo taken from the Campanile</p>
		<a class="btn btn-primary btn-lg" href="single-image.php?id=73" role="button">Learn more</a>
      </div>
    </div>

    <div class="item">
      <img src="travel-images/large/8710513053.jpg" alt="Ancient Theatre of Dionysos" class="center">
      <div class="carousel-caption">
        <h3>Ancient Theatre of Dionysos</h3>
        <p>On south bank of Acropolis</p>
		<a class="btn btn-primary btn-lg" href="single-image.php?id=75" role="button">Learn more</a>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
 
 </body>
</html>