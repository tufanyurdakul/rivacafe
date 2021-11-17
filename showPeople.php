
<?php
include("./controller/db.php");
$id = $_COOKIE["id"];
$home = $_COOKIE["home"];
$name = $_COOKIE["name"];
$surname = $_COOKIE["surname"];
$total = 0;
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
$data = json_decode($mydata);

$req_data2=array();
$req_user2 = "SELECT id,food_name FROM menu order by food_name";
$results2 = $conn->query($req_user2);
if($results2->num_rows > 0)
{
    $data2=array();
    while($data2 = $results2->fetch_assoc())
    {
        $req_data2[] = $data2;
    }
}
$mydata2 = json_encode($req_data2);
$data2 = json_decode($mydata2);

$req_data3=array();
$req_user3 = "SELECT food_type FROM menu GROUP BY food_type";
$results3 = $conn->query($req_user3);
if($results3->num_rows > 0)
{
    $data3=array();
    while($data3 = $results3->fetch_assoc())
    {
        $req_data3[] = $data3;
    }
}
$mydata3 = json_encode($req_data3);
$data3 = json_decode($mydata3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cs/modal.css">
    <title>Kişi Hesapları</title>
</head>
<body>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="sure"></h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <p>ADET:</p>
                </div>
                <div class="col-8">
                    <input class="count"></input>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <p>YEMEK TİPİ</p>
                </div>
                <div class="col-6">
                    <select class="typeOfFoods">
                        <?php foreach($data3 as $item): ?>
                        <option value=<?php echo $item->food_type; ?>><?php echo $item->food_type; ?></option>
                        <?php endforeach ?>   
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn w-100 btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <p>YEMEKLER</p>
                </div>
                <div class="col-8">
                    <select class="access">
                        <?php foreach($data2 as $item): ?>
                        <option value=<?php echo $item->id; ?>><?php echo $item->food_name; ?></option>
                        <?php endforeach ?>   
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn canceled" style="background-color:black;"><i class="fa fa-times" aria-hidden="true" style="color:red;"></i></button>  
            <button class="btn deleted" style="background-color:black;"><i class="fa fa-check" aria-hidden="true" style="color:green;"></i></button>
        </div>
    </div>
</div>
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="sure"></h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p class="info"></p>
        </div>
        <div class="modal-footer">
            <button class="btn canceled" style="background-color:black;"><i class="fa fa-times" aria-hidden="true" style="color:red;"></i></button>  
            <button class="btn deleted" style="background-color:black;"><i class="fa fa-check" aria-hidden="true" style="color:green;"></i></button>
        </div>
    </div>
</div>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
            <?php include("header.php"); ?>
        </div>
        <?php if($_SESSION["accessable"]==1): ?>
        <div class="col-9">
            <div class="row">
                <div class="col-1">
                    <span class="uid"><?php echo $id; ?></span>
                </div>
                <div class="col-10" style="text-align:center; font-size:22px; font-weight:800;">
                    <span>Daire No : <?php echo $home; ?>       -       İsim : <?php echo $name; ?> <?php echo $surname; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-3  mt-3 mb-3 mr-2">
                    <button class = "btn btn-warning w-100"><i class="fas fa-hamburger ml-2"></i><i class="fa fa-plus ml-2" aria-hidden="true"></i></button>
                </div>
                <div class="col-3 mt-3 mb-3 mr-2">
                    <button class = "btn btn-secondary w-100"><i class="fas fa-shopping-cart"></i> ÖDE</button>
                </div>    
                <div class="col-5 mt-3 mb-3 mr-2" style="text-align:center;">
                <?php foreach($data as $item): ?>
                    <?php 
                       $total += (($item->price * $item->c)-((($item->price * $item->c)*$item->reduce)/100));
                    ?>
                <?php endforeach ?> 
                <h4>TOPLAM: <?php echo $total; ?> TL</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr> 
                                <th> ID </td>
                                <th> YEMEK TARİHİ</td>
                                <th> YEMEK ADEDİ </td>
                                <th> YEMEK İSMİ </td>
                                <th> YEMEK İNDİRİMİ </td>
                                <th> YEMEK FİYATI(BİRİM) </td>
                                <th> YEMEK FİYATI(TOPLAM) </td>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php foreach($data as $item): ?>
                            <tr>
                            <th scope="col"> <?php echo $item->id; ?> </td> 
                            <th scope="col"> <?php echo $item->d; ?> </td> 
                            <th scope="col">  <?php echo $item->c; ?> </td> 
                            <th scope="col"> <?php echo $item->mname; ?> </td> 
                            <th scope="col"> %<?php echo $item->reduce; ?></td> 
                            <th scope="col"> <?php echo $item->price; ?> TL </td>
                            <th scope="col"> <?php echo ($item->price * $item->c)-((($item->price * $item->c)*$item->reduce)/100); ?> TL </td> 
                            <th scope="col b"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>     
                    </table>    
                </div>
            </div>
        </div>
        <?php elseif($_SESSION["accessable"] == 0): ?>
        <?endif ?>   
    </div>
</div>       
</body>
</html>
<script>
let id = 0;
let choosen = 0;
let canceled = document.querySelectorAll('.canceled')[0];
let canceled2 = document.querySelectorAll('.canceled')[1];
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];
let choosenFood = document.querySelector('.access');
let amount = document.querySelector('.count');
let okey = document.querySelectorAll('.deleted')[0];
let okey2 = document.querySelectorAll('.deleted')[1];
let uid = document.querySelector('.uid');
let deleteButton = document.querySelectorAll('.btn-danger');
let addItem = document.querySelector('.btn-warning');
let modal = document.querySelectorAll('.modal')[0];
let modal2 = document.querySelectorAll('.modal')[1];
let sure = document.querySelectorAll('.sure')[1];
let info = document.querySelector('.info');
let scopes = document.querySelector('.table');
let allDelete = document.querySelector('.btn-secondary');
let search = document.querySelector('.btn-success');
let typeOfFoods = document.querySelector('.typeOfFoods');
addItem.addEventListener('click',function(params)
{
    modal.style.display = "block";
    choosen = 1;
});
search.addEventListener('click',function(params)
{
    var params = 'myPass=aaaaaaaaaaa&food_type='+typeOfFoods.value;
    sendRequestForFilter(params);
});
deleteButton.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal2.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[3].innerHTML + " Yemek Silinmesi";
            info.innerHTML = "ID'si "+scopes.rows[idx+1].cells[0].innerHTML+" olan "+scopes.rows[idx+1].cells[3].innerHTML
            +"("+scopes.rows[idx+1].cells[4].innerHTML+") Yemeğini Silmek İster Misin ?";
            choosen = 2;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    allDelete.addEventListener('click',function(params)
    {
        modal2.style.display = "block";
        sure.innerHTML ="Hesabı Ödemek";
        info.innerHTML = "Bu Hesabı Ödemek İstediğine Emin Misin?";
        choosen = 3;
    });

okey.addEventListener('click',function(params){
    if(choosen == 1)
    {
        let amounts = 0;
        if(amount.value.length == 0)
        {
            amounts = 1;
        }
        else
        {
            amounts = amount.value;
        }
        var params = 'myPass=11111110&food_id='+choosenFood.value+'&user_id='+uid.innerHTML+'&amount='+amounts;
        sendRequest(params);
    }
});
okey2.addEventListener('click',function(params){
    if(choosen == 2)
    {
        var params = 'myPass=x111x111&id='+id;
        sendRequest(params);
    }
    else if(choosen == 3)
    {
        var params = 'myPass=x111x1111&id='+uid.innerHTML;
        sendRequest(params);
    }
});
canceled.onclick = function()
{
    modal.style.display = "none";  
}
canceled2.onclick = function()
{
    modal2.style.display = "none";  
}
span.onclick = function()
{
    modal.style.display = "none";
}
span2.onclick = function()
{
    modal2.style.display = "none";
}
function sendRequest(params)
{
    var http = new XMLHttpRequest();
    var url = './controller/FoodOnPersonController.php';
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() 
    {
        if(http.readyState == 4 && http.status == 200) 
        {
            if(http.responseText == "success")
            {
                modal.style.display = "none";
                location.reload();
            }
            else
            {
                alert("Başarısız.");
            }
        }
    }
    http.send(params);
}
function sendRequestForFilter(params)
{
    var http = new XMLHttpRequest();
    var url = './controller/FoodOnPersonController.php';
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() 
    {
        if(http.readyState == 4 && http.status == 200) 
        {
            var obj = JSON.parse(http.responseText);
            choosenFood.options.length = 0;
            for (var i=0; i < obj.length; i++)
            {
                var option = document.createElement("option");
                option.id = obj[i].id;
                option.value = obj[i].id;
                option.innerHTML = obj[i].food_name;                
                choosenFood.appendChild(option);
            }
        }
    }
    http.send(params);
}
</script>