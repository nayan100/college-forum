<?php 
session_start();
//connect.php
$server	    = 'localhost';
$username	= 'root';
$password	= '';
$database	= 'icollegeforum';
//
//if(!mysqli_connect($server, $username, $password))
//{
// 	exit('Error: could not establish database connection');
//}
//if(!mysqli_select_db($database))
//{
// 	exit('Error: could not select the database');
//}
$conn = mysqli_connect($server, $username, $password) or die("cannot connect"); 
mysqli_select_db($conn, $database) or die("cannot select DB");

?>