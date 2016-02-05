<?php
/*
  Table Data Gateway for the WebsiteVisits table.
 */
class WebsiteVisitsTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "WebsiteVisits";
   } 
   protected function getTableName()
   {
      return "WebsiteVisits";
   }
   protected function getOrderFields() 
   {
      return 'id';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
   
   public function getViewsByMonth($year, $month){
   $sql = "SELECT EXTRACT(day FROM dateViewed) AS date, COUNT(*) AS views FROM `websitevisits` WHERE EXTRACT(year FROM dateViewed)=? AND EXTRACT(month FROM dateViewed)=? GROUP BY EXTRACT(day FROM dateViewed)";
   $result = $this->dbAdapter->fetchAsArray($sql, Array($year, $month));   
   return $result; 
   }
   
   public function getFirstSixMonthsByYear($year){
   $sql = "SELECT CountryName, COUNT(dateViewed) AS visits FROM `websitevisits` JOIN `geocountries` ON fipsCountryCode=countrycode WHERE EXTRACT(year FROM dateViewed)= ? 
   AND (EXTRACT(month FROM dateViewed) >= 01 AND EXTRACT(month FROM dateViewed) <= 06) GROUP BY CountryName HAVING visits >= 5";
   $result = $this->dbAdapter->fetchAsArray($sql, Array($year));   
   return $result; 

   }
   public function getDropdownCountries(){
   $sql = "SELECT countryCode, CountryName, COUNT(*) AS visits FROM `websitevisits` JOIN `geocountries` ON fipsCountryCode=countrycode GROUP BY CountryName HAVING visits >= 50 ORDER BY CountryName";
   $result = $this->dbAdapter->fetchAsArray($sql);   
   return $result; 
   }
   
	public function getColumnData($first, $second, $third){
	$sql = "SELECT CountryName, EXTRACT(year FROM dateViewed) AS year, COUNT(*) AS views FROM `websitevisits` JOIN `geocountries` ON fipsCountryCode=countrycode 
	WHERE (countryCode=? OR countryCode=? OR countryCode=?) GROUP BY year, countryCode ORDER BY year";
	$result = $this->dbAdapter->fetchAsArray($sql, Array($first, $second, $third));   
    return $result;

	}
	
}
?>