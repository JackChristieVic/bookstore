<?php # Script 19.x - mysqli_connect.php
// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

//Set the database access information as constants:
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bookstore');

// DEFINE ('DB_USER', 'epiz_24273534_Admin');
// DEFINE ('DB_PASSWORD', 'el6tjLB14VtYNH');
// DEFINE ('DB_HOST', 'localhost');
// DEFINE ('DB_NAME', 'epiz_24273534_bookstore');
// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
	OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');