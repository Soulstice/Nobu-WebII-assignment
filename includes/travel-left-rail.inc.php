<?php 
require_once('travel-setup.inc.php');

function outputContinents($dbAdapter) {
		$gate = new ContinentTableGateway($dbAdapter);
		$result = $gate->findAllSorted();
		foreach ($result as $row)
		{
			echo '<li class="list-group-item">
			<a href="browse-images.php?=#">'. $row->ContinentName . '</a></li>';
		}
}

function outputCountries($dbAdapter) {
		$gate = new CountryTableGateway($dbAdapter);
		$result = $gate->findCountriesWithImages();
		foreach ($result as $row)
		{
		echo '<li class="list-group-item">
			<a href="single-country.php?iso='.$row->ISO . '">'.$row->CountryName .'</a></li>';
		}
}

?>


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
         </div>  <!-- end search panel -->       
      
         <div class="panel panel-info">
           <div class="panel-heading">Continents</div>
           <ul class="list-group">   
				<?php outputContinents($dbAdapter); ?>

           </ul>
         </div>  <!-- end continents panel -->  
         <div class="panel panel-info">
           <div class="panel-heading">Popular Countries</div>
           <ul class="list-group">  
				<?php outputCountries($dbAdapter); ?>
  
           </ul>
         </div>  <!-- end countries panel -->    