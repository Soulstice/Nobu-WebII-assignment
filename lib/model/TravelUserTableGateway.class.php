<?php
/*
  Table Data Gateway for the TravelUser table.
 */
class TravelUserTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelUser";
   } 
   protected function getTableName()
   {
      return "TravelUser";
   }
   protected function getOrderFields() 
   {
      return 'UserName';
   }
  
   protected function getPrimaryKeyName() {
      return "UID";
   }

   protected function getSelectStatement() {
      return $this->getSQLwithJoins();
   }   
   
   public function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT TravelUser.UID as UID, UserName, Pass, State, DateJoined, DateLastModified, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM TravelUser INNER JOIN TravelUserDetails ON TravelUser.UID = TravelUserDetails.UID ";  
      
      return $SQLwithJoins;
   }
   
   // must override this
   public function findById($id)
   {
      $sql = $this->getSQLwithJoins() . ' WHERE TravelUser.UID=:id';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }   

}

?>