<?php
require_once('./config.php');

spl_autoload_register(function ($class) {
    $file = './lib/dataAccess/' . $class . '.class.php';
    if (file_exists($file)) {
		//echo $file . "<br>";
      include $file;
	  }
    else {
      include './lib/model/' . $class . '.class.php';
	}
});

include "./lib/model/FavoriteImage.class.php";
include "./lib/model/FavoritePost.class.php";
include ("./lib/model/cartItem.class.php");

session_start();
$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>