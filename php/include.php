<?php

$connection =  mysqli_connect('127.0.0.1','root','','nixcourse');

if( $connection == false ){
	echo "Yoy lose<br>";
	echo mysqli_connect_error();
	exit();
} 
?>