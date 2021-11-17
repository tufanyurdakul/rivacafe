<?php
session_start();
include("db.php");
$id = $_SESSION["userId"];
 $req_data=array();
 $req_user = "SELECT show_users.id as id ,show_users.count as c,show_users.date as d ,show_users.reduce as reduce, menu.food_name as mname , show_users.price as price   FROM show_users 
 INNER JOIN menu ON menu.id = show_users.menu_id  
 WHERE show_users.users_id = '$id' ORDER BY d DESC";
 $results = $conn->query($req_user);

 if($results->num_rows > 0)
 {
    $data=array();
    while($data = $results->fetch_assoc())
    {
      $req_data[] = $data;
    }
 }
 $mydata = json_encode($req_data);
?>