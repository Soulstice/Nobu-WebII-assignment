<?php
/*
   Represents a single row for the travelImage table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelImage extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ImageID','UID','Path','ImageContent');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>