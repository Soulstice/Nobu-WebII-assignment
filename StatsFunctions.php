<?php

function populateDropdown($result){
	echo "<option value='default'>Select Country</option>";
foreach($result AS $list){
	echo "<option value='" . $list['countryCode'] . "'>" . $list['CountryName'] . "</option>";
}
}

function getDropDownCountries($dbAdapter) {
$gate = new WebsiteVisitsTableGateway($dbAdapter);
$result = $gate->getDropdownCountries();

			echo "<select id='C1' name='C1' onchange='checkSelections()'>";
			populateDropdown($result);
			echo "</select>";
			echo "<select id='C2' name='C2' onchange='checkSelections()'>";
			populateDropdown($result);
			echo "</select>";
			echo "<select id='C3' name='C3' onchange='checkSelections()'>";
			populateDropdown($result);
			echo "</select>";

}

function viewsLastMonth($dbAdapter) {
	$year = idate('Y');
	$month = idate('m') -1;
	
	if($month == 0){ $month = 12;
						$year = $year--;}
	
	
	$gate = new WebsiteVisitsTableGateway($dbAdapter);
	$result = $gate->getViewsByMonth($year, $month);
	
	$viewsTable = "[
			['Day', 'Views'],";
			
	foreach($result AS $view){
	$viewsTable .= "['" .$view['date'] . "'," . $view['views'] .  "]";
	if($view['date'] != 30){$viewsTable .= ",";}
	
	}
	$viewsTable .= "]";

return $viewsTable;
}

function viewsFirstSixMonthsByYear($dbAdapter){
	$gate = new WebsiteVisitsTableGateway($dbAdapter);
	$result = $gate->getFirstSixMonthsByYear(idate('Y'));
	
	$geoTable = "[
			['Country', 'Total Views'],";
	$last = end($result);
			
	foreach($result AS $country){
	$geoTable .= "['" .$country['CountryName'] . "'," . $country['visits'] .  "]";	
	if($country != $last){ $geoTable .= ",";} 
	}
	
	$geoTable .= "]";
	
return $geoTable;
	}
	
function getColumnChartResults($dbAdapter, $C1, $C2, $C3){
$gate = new WebsiteVisitsTableGateway($dbAdapter);
$result = $gate->getColumnData($C1, $C2, $C3);

$columnData = "['Year', '" . $result[0]['CountryName'] ."', '". $result[1]['CountryName'] ."', '" . $result[2]['CountryName'] . "'],";
$columnData .= "['2014', " . $result[0]['views'] . ", " . $result[1]['views'] . ", " . $result[2]['views'] . "],";
$columnData .= "['2015', " . $result[3]['views'] . ", " . $result[4]['views'] . ", " . $result[5]['views'] . "],";
$columnData .= "['2016', " . $result[6]['views'] . ", " . $result[7]['views'] . ", " . $result[8]['views'] . "]";

return $columnData;
}
	


?>