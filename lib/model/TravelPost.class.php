<?php
/*
   Represents a single row for the TravelPost table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelPost extends DomainObject
{  
   
   static function getFieldNames() {
      return array('PostID','UID','ParentPost','Title','Message','PostTime');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>