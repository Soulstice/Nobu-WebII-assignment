<?php
/*
  Table Data Gateway for the Continent table.
 */
class ContinentTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Continent";
   } 
   protected function getTableName()
   {
      return "GeoContinents";
   }
   protected function getOrderFields() 
   {
      return 'ContinentName';
   }
  
   protected function getPrimaryKeyName() {
      return "ContinentCode";
   }


}

?>