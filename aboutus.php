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
			   <li class="active">About Us</li>
			 </ol>       
			 
			 <div class="jumbotron">
			 <h1>About Us</h1>
			 <p>This assignment was created by Nobufumi Takahashi, Garrett Irwin, and Dorothy Siwek</p>
			 <p>It was created for COMP 3512 at Mount Royal University. Taught by Randy Connolly</p>
			 <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
			 </div>
			<div class="well">
			<h3>Rough Breakup of tasks:</h3>
			<ul>
			<li>Statistics page by Dorothy Siwek. </li>
			<li>Cart JavaScript implementation by Garrett Irwin.</li>
			<li>Browse Image Preview and Travel Image Map by Nobu Takahashi</li>
			<li>Nobu Takahashi's Assignment 1 used as the base.</li>
			<li>Class approach implemented by Nobu Takahashi</li>
			<li>Navigation implemented by Nobu Takahashi and Garrett Irwin</li>
			<li>Site Design and About Page by Dorothy Siwek</li>
			<li>Search Functionality by Dorothy Siwek</li>
			<li>Favourites functionality by Nobu Takahashi</li>
			<li>Cart Class by Dorothy Siwek and Garrett Irwin</li>
			<li>Cart Functionality by Garrett Irwin</li>
			</ul>
			
			<h3>Resources Used:</h3>
			<ul>
			<li>W3Schools</li>
			<li>Bootstrap Documentation</li>
			<li>StackOverflow</li>
			<li>Jordan Pratt</li>
			</ul>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>   
 
 </body>
</html>