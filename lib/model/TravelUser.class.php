<?php
/*
   Represents a single row for the TravelUser table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelUser extends DomainObject
{  
   
   static function getFieldNames() {
      return array('UID', 'UserName', 'Pass', 'State', 'DateJoined', 'DateLastModified', 'FirstName', 'LastName', 'Address', 'City', 'Region', 'Country', 'Postal', 'Phone', 'Email', 'Privacy');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>