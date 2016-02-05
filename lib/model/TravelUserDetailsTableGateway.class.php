<?php
/*
  Table Data Gateway for the TravelUserDetailsTable table.
 */
class TravelUserDetailsTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelUserDetails";
   } 
   protected function getTableName()
   {
      return "TravelUserDetails";
   }
   protected function getOrderFields() 
   {
      return 'UID';
   }
  
   protected function getPrimaryKeyName() {
      return "UID";
   }
}
?>