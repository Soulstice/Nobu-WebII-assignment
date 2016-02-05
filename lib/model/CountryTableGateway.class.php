<?php
/*
  Table Data Gateway for the Country table.
 */
class CountryTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Country";
   } 
   protected function getTableName()
   {
      return "GeoCountries";
   }
   protected function getOrderFields() 
   {
      return 'ISO';
   }
  
   protected function getPrimaryKeyName() {
      return "ISO";
   }

      public function findCountriesWithImages()
   {
      $sql = "SELECT ISO, fipsCountryCode, ISO3, ISONumeric, CountryName, Capital, GeoNameID, Area,Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, PostalCodeFormat, PostalCodeRegex, Neighbours, CountryDescription
FROM GeoCountries INNER JOIN TravelImageDetails ON GeoCountries.ISO = TravelImageDetails.CountryCodeISO
GROUP BY ISO, fipsCountryCode, ISO3, ISONumeric, CountryName, Capital, GeoNameID, Area, Population, Continent, GeoCountries.TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, PostalCodeFormat, PostalCodeRegex, Neighbours, CountryDescription Order By CountryName";  
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }

}

?>