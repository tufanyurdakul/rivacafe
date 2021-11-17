<?php
include("db.php");
$myPass = $_POST['myPass'];
if($myPass === "11001010")
{
   addFood($conn);            
}
else if($myPass == 'xxxxxxxxxx')
{
   deleteFood($conn);
}
else if($myPass == 'xa100axxa')
{
   editFood($conn);
}
else
{
  $mydata = getFoods($conn);
}
function getFoods($conn)
{
   $req_data=array();
   $req_user = "SELECT * FROM menu ORDER BY food_name";
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
   return $mydata;
}
function addFood($conn)
{
   $name = $_POST['name'];
   $price = $_POST['price'];
   $stock = $_POST['stock'];
   $reduce = $_POST['sale'];
   $food_type = $_POST['food_type'];
   $isThere = "SELECT id FROM menu WHERE food_name = '$name'";
   $results = $conn->query($isThere);
   if($results->num_rows > 0)
   {
      echo "there";   
   }
   else
   {
      $sql = "INSERT INTO menu (food_name,food_price,food_stock,food_reduce,food_type) VALUES ('$name','$price','$stock','$reduce','$food_type')";
      if($conn->query($sql) === TRUE)
      {
         echo "success";
      }
      else
      {
         echo "no success";
      }
   }
}
function deleteFood($conn)
{
   $id = $_POST["id"];
   $req_user = "DELETE FROM menu WHERE id = '$id'";
   if($conn->query($req_user)===TRUE)
   {
      echo 'success';
   }
   else
   {
      echo 'no success';
   } 
}
function editFood($conn)
{
     $id = $_POST["id"];
     $name = $_POST["name"];
     $price = $_POST["price"];
     $stock = $_POST["stock"];
     $reduce = $_POST["sale"];
     $food_type = $_POST['food_type'];
     $sql = "UPDATE menu SET  food_name='$name',food_price='$price',food_stock='$stock',food_reduce='$reduce',food_type ='$food_type' WHERE id = '$id'";
     if($conn->query($sql) === TRUE)
     {
         echo "success";
     }
     else
     {
         echo "no success";
     }
}
?>