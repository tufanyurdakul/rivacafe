<?php
$servername = "";
$username = "";
$password = "";
$database ="";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
