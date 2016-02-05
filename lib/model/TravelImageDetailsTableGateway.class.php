<?php
/*
  Table Data Gateway for the City table.
 */
class TravelImageDetailsTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelImageDetails";
   } 
   protected function getTableName()
   {
      return "TravelImageDetails";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
   protected function getPrimaryKeyName() {
      return "ImageID";
   }
  
}

?>