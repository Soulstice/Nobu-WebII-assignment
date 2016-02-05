<?php
/*
   Represents a single row for the TravelImageDetails table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelImageDetails extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ImageID','Title','Description','Latitude','Longitude','CityCode','CountryCodeISO');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>