<?php
$hostName = "securepassword";
$userName = "asouser";
$password = "securepassword";
$dbName = "aso_practice";
$conn = new mysqli($hostName, $userName, $password, $dbName);
if ($conn) {
	echo "connected";
} else {
	echo "not connected";
}
?>