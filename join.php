<?php 
	session_start();
	include 'database.php';
	include 'function.php';
	
 	global $pdo;

  	$getFromU = new functions($pdo);
    
  	define('BASE_URL', 'http://localhost/NewPHP/');
 ?>                                                   
 