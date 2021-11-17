<?php
   session_start();
   $myPass = $_POST['myPass'];
   include("db.php");
   if($myPass === "01101100")
   {
      $no = $_POST['no'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];
      $phone = $_POST['phone'];
      $pass = $_POST['pass'];
      $isFull = "SELECT id FROM request_user";
      $results = $conn->query($isFull);
      if($results->num_rows <= 50)
      {
         $controlUser = "SELECT id FROM users WHERE home_no='$no'";
         $result2 = $conn->query($controlUser);
         if ($result2->num_rows > 0)
         {
            echo "registered";
         }
         else 
         {
            $controlUser2 = "SELECT id FROM request_user WHERE home_no='$no'";
            $result3 = $conn->query($controlUser2);
            if ($result3->num_rows > 0)
            {
               echo "registered2";
            }
            else
            {
               $sql = "INSERT INTO request_user (home_no,pass,username,surname,phone) VALUES ('$no','$pass','$name','$surname','$phone')";
               if($conn->query($sql) === TRUE)
               {
                  echo "inserted";
               }
               else
               {
                  echo "no inserted";
               }
            }
            
         }
      }
      else
      {
         echo "number";
      }
   }
   else if($myPass == "aaaa")
   {
      $id = $_SESSION["userId"];
      $oldPass = $_POST["old_pass"];
      $newPass = $_POST["new_pass"];
      $controlUser = "SELECT id FROM users WHERE id='$id' AND pass = '$oldPass'";
      $result2 = $conn->query($controlUser);
      if ($result2->num_rows > 0)
      {
         $sql = "UPDATE users SET pass='$newPass' WHERE id = '$id'";
         if($conn->query($sql) === TRUE)
         {
            echo "success";
         }
         else
         {
            echo "not success";
         }
      }
      else
      {
         echo "wrong";
      }
   }

?>