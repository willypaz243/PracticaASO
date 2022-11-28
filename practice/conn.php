<?php
$hostName = "localhost";
$userName = "asouser";
$password = "securepassword";
$dbName = "aso_practice";
$conn = new mysqli($hostName, $userName, $password, $dbName);
if ($conn) {
	echo "MYSQL -> connected\n";
} else {
	echo "MYSQL -> not connected\n";
}
?>