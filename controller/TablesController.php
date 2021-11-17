<?php
include("db.php");
$myPass = $_POST["myPass"];
if($myPass == "xaaxxxxx")
{
   addTable($conn);
}
else if($myPass == '11111110')
{
    addFood($conn);
}
else if($myPass == 'x111x111')
{
    deleteFood($conn);
}
else if($myPass=='x111x1111')
{
  deleteAll($conn);
} 
else if($myPass=='x0x10000')
{
   translate($conn);
}
else if($myPass=='0x1a1aa1')
{
   dtable($conn);
}   
else
{
   $mydata = getTables($conn);
}

function getTables($conn)
{
    $req_data=array();
    $req_user = "SELECT * FROM tables Order By table_name";
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
function addTable($conn)
{
   $name = $_POST['table_name'];
   $isThere = "SELECT id FROM tables WHERE table_name = '$name'";
   $results = $conn->query($isThere);
   if($results->num_rows > 0)
   {
      echo "there";   
   }
   else
   {
      $sql = "INSERT INTO tables (table_name) VALUES ('$name')";
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
function addFood($conn)
{
    $food_id = $_POST["food_id"];
    $table_id = $_POST["table_id"];
    $date = date("Y-m-d");
    $amount = $_POST["amount"];
    $req_user = "SELECT  show_tables.id AS id,show_tables.count AS amounts FROM show_tables 
    WHERE show_tables.food_id = '$food_id' AND show_tables.table_id = '$table_id' AND date = '$date'
    LIMIT 1";
    $results = $conn->query($req_user);
    if($results->num_rows > 0)
    {
        $data2=array();
        $dbAmount=0;
        $id=""; 
        while($data2 = $results->fetch_assoc())
        {
        $dbAmount = $data2["amounts"];
        $id = $data2["id"];
        }
        $dbAmount = $dbAmount + $amount;
        $sql = "UPDATE show_tables SET count = '$dbAmount' WHERE id = '$id'";
        if($conn->query($sql) === TRUE)
        {
            $sqlc = "UPDATE menu SET food_stock = food_stock -$amount WHERE id = '$food_id'";
            if($conn->query($sqlc) === TRUE)
            {
               echo "success";
            }
            else
            {
               echo "no success";
            }
        }
        else
        {
            echo "no success";
        }
   }
   else
   {
        $sqlx = "INSERT INTO show_tables (table_id,food_id,count,date) SELECT '$table_id','$food_id','$amount','$date'
        FROM menu WHERE id = '$food_id'";
        if($conn->query($sqlx) === TRUE)
        {
            $sqla = "UPDATE menu SET food_stock = food_stock -$amount WHERE id = '$food_id'";
            if($conn->query($sqla) === TRUE)
            {
               echo "success";
            }
            else
            {
               echo "no success";
            }
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
    $req_user = "DELETE FROM show_tables WHERE id = '$id'";
    if($conn->query($req_user)===TRUE)
    {
        echo 'success';
    }
    else
    {
        echo "no success";
    }
}
function deleteAll($conn)
{
    $id = $_POST["id"];
    $req_user = "DELETE FROM show_tables WHERE table_id = '$id'";
    if($conn->query($req_user)===TRUE)
    {
        echo 'success';
    }
    else
    {
        echo "no success";
    }
}
function dtable($conn)
{
   $table_id = $_POST["table_id"];
   $req_user = "DELETE FROM tables WHERE id = '$table_id'";
   if($conn->query($req_user)===TRUE)
   {
       echo 'success';
   }
   else
   {
       echo "no success";
   }
}
function translate($conn)
{
   $table_id = $_POST["table_id"];
   $user_id = $_POST["user_id"];
   $sqlx = "INSERT INTO show_users (users_id,menu_id,date,reduce,count,price) SELECT '$user_id',show_tables.food_id,show_tables.date,menu.food_reduce,show_tables.count,menu.food_price
   FROM show_tables 
   INNER JOIN menu ON menu.id = show_tables.food_id
   WHERE table_id = '$table_id'";
   if($conn->query($sqlx) === TRUE)
   {
      $req_user = "DELETE FROM show_tables WHERE table_id = '$table_id'";
      if($conn->query($req_user)===TRUE)
      {
          echo 'success';
      }
      else
      {
          echo "no success";
      }
   }
   else
   {
       echo "no success";
   }
}

?>