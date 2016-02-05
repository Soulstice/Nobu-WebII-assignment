<?php
/*
  Table Data Gateway for the TravelImage table.
 */
class TravelPostImagesTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelPostImages";
   } 
   protected function getTableName()
   {
      return "travelpostimages";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
  
   protected function getPrimaryKeyName() {
      return "PostID";
   }
}
?>