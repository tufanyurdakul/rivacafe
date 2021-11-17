<?php
session_start();
include("db.php");
$myPass = $_POST['myPass'];
if($myPass === "11000110")
{
    $no = $_POST['no'];
    $pass = $_POST['pass'];
    $controlUser = "SELECT id,access FROM users WHERE home_no='$no' AND pass='$pass'";
    $results = $conn->query($controlUser);
    if($results->num_rows > 0)
    {
       $data=array();
       while($data = mysqli_fetch_assoc($results))
       {
        $_SESSION["userId"] = $data["id"];
        $_SESSION["accessable"] = $data["access"];
       }
       echo "login";
    }
    else
    {
        $controlUser2 = "SELECT id FROM request_user WHERE home_no='$no' AND pass='$pass'";
        $results2 = $conn->query($controlUser2);
        if($results2->num_rows > 0)
        {
            echo "requestUser";
        }
        else
        {
            echo "not";
        }
    }
}

?>