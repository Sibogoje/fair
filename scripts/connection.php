<?php
$servername = "194.5.156.43";
$username = "u747325399_fair2";
$password = "Fairline@151022";
$dbname   = 'u747325399_fair2';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>