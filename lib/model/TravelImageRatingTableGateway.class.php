<?php
/*
  Table Data Gateway for the TravelImageRating table.
 */
class TravelImageRatingTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelImageRating";
   } 
   protected function getTableName()
   {
      return "TravelImageRating";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
  
   protected function getPrimaryKeyName() {
      return "ImageRatingID";
   }

   public function findForImage($imageID)
   {
      return $this->findBy('ImageID=?',Array($imageID));   
   }
   
   public function averageForImage($imageID)
   {
      $sql = "SELECT AVG(Rating) FROM TravelImageRating WHERE ImageID=?";
      $result = $this->dbAdapter->fetchField($sql, Array($imageID));
      return $result;
   }
}

?>