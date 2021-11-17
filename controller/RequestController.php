<?php
include("db.php");
$myPass = $_POST["myPass"];
if($myPass == '11111111')
{
      deleteReq($conn);
}
else if($myPass == '11111110')
{
      addReq($conn);
}
else 
{
      $mydata = getReq($conn);
}
function getReq($conn)
{
      $req_data=array();
      $req_user = "SELECT * FROM request_user";
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
function deleteReq($conn)
{
      $id = $_POST["id"];
      $req_user = "DELETE  FROM request_user WHERE id = '$id'";
       if($conn->query($req_user)===TRUE)
       {
             echo 'success';
       }
       else
       {
             echo 'not success';
       }
}
function addReq($conn)
{
      $id = $_POST["id"];
      $sql = "INSERT INTO users (home_no,pass,name,surname,phone,access) SELECT home_no,pass,username,surname,phone,'0'
      FROM request_user WHERE id = '$id'";
      $req_user = "DELETE  FROM request_user WHERE id = '$id'";
      if($conn->query($sql) === TRUE && $conn->query($req_user)===TRUE)
      {
            echo "success";
      }
      else
      {
            echo "not success";
      }
      
}     
?>