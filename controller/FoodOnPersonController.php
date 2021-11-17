<?php
include("db.php");
$myPass = $_POST["myPass"];
if($myPass == '11111110')
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
else if($myPass == 'aaaaaaaaaaa')
{
   filter($conn);
}     
function addFood($conn)
{
    $food_id = $_POST["food_id"];
    $user_id = $_POST["user_id"];
    $date = date("Y-m-d");
    $amount = $_POST["amount"];
    $req_user = "SELECT  show_users.id AS id,show_users.count AS amounts,menu.food_stock as stock FROM show_users INNER JOIN menu ON show_users.menu_id = menu.id 
    WHERE show_users.menu_id = '$food_id' AND show_users.users_id = '$user_id' AND date = '$date' AND show_users.reduce = menu.food_reduce
    AND show_users.price = menu.food_price
    LIMIT 1";
    $results = $conn->query($req_user);
    if($results->num_rows > 0)
    {
        $data2=array();
        $dbAmount=0;
        $stock = 0;
        $id=""; 
        while($data2 = $results->fetch_assoc())
        {
        $dbAmount = $data2["amounts"];
        $stock = $data2["stock"];
        $id = $data2["id"];
        }
        $dbAmount = $dbAmount + $amount;
        $sql = "UPDATE show_users SET count = '$dbAmount' WHERE id = '$id'";
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
        $sqlx = "INSERT INTO show_users (users_id,menu_id,date,reduce,count,price) SELECT '$user_id','$food_id','$date',food_reduce,'$amount',food_price
        FROM menu WHERE id = '$food_id'";
        if($conn->query($sqlx) === TRUE)
        {
            $sqlv = "UPDATE menu SET food_stock = food_stock - $amount WHERE id = '$food_id'";
            if($conn->query($sqlv) === TRUE)
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
    $req_user = "DELETE FROM show_users WHERE id = '$id'";
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
    $req_user = "DELETE FROM show_users WHERE users_id = '$id'";
    if($conn->query($req_user)===TRUE)
    {
        echo 'success';
    }
    else
    {
        echo "no success";
    }
}
function filter($conn)
{
    $food_type = $_POST["food_type"];
    if($food_type == NULL)
    {
        $req_filter = "SELECT * from menu WHERE food_type IS NULL order by food_name ";
    }
    else
    {
        $req_filter = "SELECT * from menu WHERE food_type = '$food_type' order by food_name ";
    }
    $req_data=array();
    $results = $conn->query($req_filter);
    if($results->num_rows > 0)
    {
       $data=array();
       while($data = $results->fetch_assoc())
       {
         $req_data[] = $data;
       }
    }
    $mydata = json_encode($req_data);
    echo "".$mydata;
}
?>