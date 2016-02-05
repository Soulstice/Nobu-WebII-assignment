<?php
/*
  Table Data Gateway for the City table.
 */
class TravelPostTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelPost";
   } 
   protected function getTableName()
   {
      return "TravelPost";
   }
   protected function getOrderFields() 
   {
      return 'PostID';
   }
   protected function getPrimaryKeyName() {
      return "PostID";
   }
   public function findForPosts($userID){
	  $sql = $this->getSelectStatement();
      $sql .= " WHERE UID=?";
      $result = $this->dbAdapter->fetchAsArray($sql, Array($userID));   
      return $this->convertRecordsToObjects($result);   
   }
}

?>