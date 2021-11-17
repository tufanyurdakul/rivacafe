<?php
include("db.php");
$myPass = $_POST["myPass"];
if($myPass=='00000000')
{
  editData($conn);
}
else if($myPass=='01010101')
{
  deleteData($conn);
}
else 
{
  $mydata = json_encode(getData($conn));
}
function getData($conn)
{
  $req_data=array();
  $req_user = "SELECT * FROM users ORDER BY name ";
  $results = $conn->query($req_user);
  if($results->num_rows > 0)
  {
    $data=array();
    while($data = $results->fetch_assoc())
    {
      $req_data[] = $data;
    }
  }
  return $req_data;
}
function editData($conn)
{
    $id = $_POST["id"];
    $home_no = $_POST["no"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $access = $_POST["access"];
    $sql = "UPDATE users SET  home_no='$home_no',name='$name',surname='$surname',phone='$phone',access='$access' WHERE id = '$id'";
    if($conn->query($sql) === TRUE)
    {
      echo "success";
    }
    else
    {
      echo "not success";
    }
}
function deleteData($conn)
{
  $id = $_POST["id"];
  $req_user = "DELETE  FROM users WHERE id = '$id'";
  if($conn->query($req_user)===TRUE)
  {
    echo 'success';
  }
  else
  {
    echo 'not success';
  }
}
?>