<?php
$servername = "localhost:3306";
$username = "ptowncC3_dbrest";
$password = "Sikintiyok87";
$database ="ptowncc3_dbrest";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>