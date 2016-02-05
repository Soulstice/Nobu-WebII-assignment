<?php
/*
  Table Data Gateway for the City table.
 */
class CityTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "City";
   } 
   protected function getTableName()
   {
      return "GeoCities";
   }
   protected function getOrderFields() 
   {
      return 'AsciiName';
   }
   protected function getPrimaryKeyName() {
      return "GeoNameID";
   }
   
   public function findCitiesWithImages()
   {
      $sql = "SELECT GeoNameID, AsciiName, GeoCities.CountryCodeISO as CountryCodeISO, GeoCities.Latitude as Latitude, GeoCities.Longitude as Longitude, Population, Elevation FROM GeoCities INNER JOIN TravelImageDetails ON GeoCities.GeoNameID = TravelImageDetails.CityCode GROUP BY GeoCities.GeoNameID, GeoCities.AsciiName ORDER BY AsciiName  ";  
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }
}

?>