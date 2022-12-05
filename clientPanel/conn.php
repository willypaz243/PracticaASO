<?php
$hostName = "localhost";
$userName = "root";
$password = "password";
$dbName = "web_sites";
$conn = new mysqli($hostName, $userName, $password, $dbName);
if ($conn) {
	echo "MYSQL -> connected\n";
} else {
	echo "MYSQL -> not connected\n";
}
?>