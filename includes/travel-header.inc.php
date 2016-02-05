<?php

function favoriteNum(){
	$num = 0;
	if(isset($_SESSION['favoriteImageList']) && !isset($_SESSION['favoritePostList'])) {
		$num = count($_SESSION['favoriteImageList']) + 0;
	}
	elseif (!isset($_SESSION['favoriteImageList']) && isset($_SESSION['favoritePostList'])) {
		$num = 0 + count($_SESSION['favoritePostList']);
	}
	elseif (isset($_SESSION['favoriteImageList']) && isset($_SESSION['favoritePostList'])) {
		$num = count($_SESSION['favoriteImageList']) + count($_SESSION['favoritePostList']);
	}
	echo '<span class="badge">'. $num .'</span>';
}

function cartNum(){
	
	if(!empty($_SESSION["Cart"]))
	{
		$num = count($_SESSION["Cart"]);
		echo '<span class="badge">'. $num .'</span>';
	}
	else
		echo '<span class="badge">0</span>';
}

?>

<header>
   <div id="topHeaderRow">
      <div class="container">
         <div class="pull-right">
            <ul class="list-inline">
              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
              <li><a href="browse-favorites.php"><span class="glyphicon glyphicon-star"></span> Favorites <?php favoriteNum(); ?></a></li>
			  <li><a href="browse-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<?php cartNum(); ?> </a></li>
			</ul>         
         </div>
      </div>
   </div>  <!-- end topHeaderRow -->
   
    <div class="navbar navbar-default ">
      <div class="container">
         <nav>
           <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="index.php">Share Your Travels</a>
           </div>
           <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav">
               <li><a href="index.php">Home</a></li>
               <li><a href="aboutus.php">About</a></li>
               <li class="dropdown">
                 <a href="browse.php" class="dropdown-toggle" data-toggle="dropdown">Browse <b class="caret"></b></a>
                 <ul class="dropdown-menu">
                   <li><a href="browse.php">Browse</a></li>
				   <li class="divider"></li>
                   <li><a href="browse-countries.php">Countries</a></li>
                   <li><a href="browse-images.php">Images</a></li>
                   <li><a href="browse-posts.php">Posts</a></li> 
				   <li><a href="browse-users.php">Users</a></li>
				   <li><a href="statistics.php">Stats</a></li>
				   <li><a href="browse-favorites.php">Favorites <?php favoriteNum(); ?></a></li>
				   <li><a href="browse-cart.php">Cart<?php cartNum(); ?></a></li>
                 </ul>
               </li>
             </ul>
           </div><!-- end navbar collapse -->
        </nav>
      </div>
    </div>  <!-- end navbar -->
</header>

