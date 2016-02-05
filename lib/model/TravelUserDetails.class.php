<?php
/*
   Represents a single row for the TravelPostImage table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelUserDetails extends DomainObject
{  
   
   static function getFieldNames() {
      return array('UID','FirstName', 'LastName','Address','City','Region','Country','Postal','Phone','Email','Privacy');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>