<?php
/*
  An example of a Factory Method design pattern. This one is 
  responsible for instantiating the appropriate data adapter
*/  
class DatabaseAdapterFactory
{
   /*
      Returns the appropriate instatiated DatabaseAdapter subclass
      
      $type -- string containing the name of the DatabaseAdapter subclass
      $connectionValues -- array containing connection details (see doc for DatabaseAdapterInterface)
   */
    public static function create($type, $connectionValues) {
        $adapter = "DatabaseAdapter" . $type;
        if (class_exists($adapter)) {
            return new $adapter($connectionValues);
        }
        else {
            throw new Exception("Data Adapter type does not exist");
        }
    } 
}
?>