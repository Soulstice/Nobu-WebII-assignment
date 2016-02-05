<?php
require_once('includes/travel-setup.inc.php');
include ('includes/functions.php');

function generateFavoriteList($sessionName,$tableName,$type) {
	if (!isset($_SESSION[$sessionName])) {
		echo '<h1> No '.$tableName.' is Added </h1>';
	}
	else {
		echo '<table class="table">
			<caption>'.$tableName.'</caption>
			<tr>
				<th>Image</th>
				<th>Title</th>
				<th>Action</th>
			</tr>';
		foreach ($_SESSION[$sessionName] as $favorite) {
			$id = $favorite->__get($type.'ID');
			$path = $favorite->__get('path');
			$title = $favorite->__get('title');

			echo '<tr style="border-bottom:2px solid #596a7b "><td><img src="travel-images/square-small/'.$path.'"></td>
				<td><a href="single-'.$type.'.php?id='.$id.'">'.$title.'</a></td>
				<td><a class="btn btn-primary btn-lg" href="removeFavorite.php?delete-'.$type.'='.$id.'" role="button">Remove</a></td>';		
		}
			
		echo '</table>
			<a class="btn btn-primary btn-lg" href="removeFavorite.php?delete-all-'.$type.'" role="button">Remove All '.$tableName.'</a>';	
		}
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
			   <li class="active">Favorites</li>
			</ol>
				<div class='well'>
				<?php generateFavoriteList("favoriteImageList","Favorite Image","image");
					  generateFavoriteList("favoritePostList","Favorite Post","post");?>
				</div>
		</div>
		
		</div>
	</div>


<?php include 'includes/travel-footer.inc.php'; ?>   

<?php include 'includes/javascript.php'; ?>  
 
 </body>
</html>