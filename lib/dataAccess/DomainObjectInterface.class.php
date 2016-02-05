<?php
/*
  Specifies the functionality of any domain object class 
 */
interface DomainObjectInterface
{
   // return an array of the field/property names of the domain object
   static function getFieldNames();
   
   // return a string containing the XML representation of the domain object
   function getXML();
}

?>