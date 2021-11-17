<?php 
include("./controller/TablesController.php");
$data = json_decode($mydata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cs/modal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Masalar</title>
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
                            <p>Masa Ismi:</p>
                        </div>
                        <div class="col-8">
                            <input class="tablename"></input>
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
                    <div class="row">
                        <div class="col-4">
                            <p>Masa Sil:</p>
                        </div>
                        <div class="col-8">
                            <select class="access">
                                <?php foreach($data as $item): ?>
                                <option value=<?php echo $item->id; ?>><?php echo $item->table_name; ?></option>
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
<div class="container-fluid p-0">
        <div class="row">
        <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
                <?php include("header.php"); ?>
            </div>
            <?php if($_SESSION["accessable"]==1): ?>
        <div class="col-9">
            <div class="row mb-3 mt-3">
                <div class="col-3">
                    <button class = "btn btn-warning w-100"><i class="fa fa-table" aria-hidden="true"></i><i class="fa fa-plus ml-2" aria-hidden="true"></i></button>
                </div>
                <div class="col-3">
                    <button class = "btn btn-danger w-100"><i class="fa fa-trash" aria-hidden="true"></i> MASA SİL</button>
                </div>
            </div>
            <div class="row">
                <?php foreach($data as $item): ?>
                <div class="col-4 mt-3">
                    <button value="<?php echo $item->id ;?>" class="btn btn-primary tables w-100" style="height:100px; font-size:21px; font-weight:700;"><?php echo $item->table_name; ?></button>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <?php endif ?>
     </div>       
</body>
</html>
<script>
let add = 0;
let addButton = document.querySelector('.btn-warning');
let deleteButton = document.querySelector('.btn-danger');


let modal = document.querySelectorAll('.modal')[0];
let modal2 = document.querySelectorAll('.modal')[1];

let btnOk = document.querySelectorAll('.deleted')[0];
let btnOk2 = document.querySelectorAll('.deleted')[1];

let tName = document.querySelector('.tablename');

let canceled = document.querySelectorAll('.canceled')[0];
let canceled2 = document.querySelectorAll('.canceled')[1];

var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];

let showTable = document.querySelectorAll('.tables');
let choosenTable = document.querySelector('.access');


showTable.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            let tableName = item.value.replace(/\s/g,"");
            document.cookie = "table_id = "+tableName;
            location.href = "./showTables.php";
        });
    });

addButton.addEventListener('click',function(params)
{
    add = 1;
    modal.style.display = "block";
});
deleteButton.addEventListener('click',function(params)
{
    add = 2;
    modal2.style.display = "block";
});
btnOk.addEventListener('click',function(params)
{
    if(add == 1)
    {
        let tableName = tName.value.replace(/\s/g,"");
        let params = "myPass=xaaxxxxx&table_name="+tableName;
        sendRequest(params);
    } 
});
btnOk2.addEventListener('click',function(params)
{
    if(add == 2)
    {
        let tableName = choosenTable.value.replace(/\s/g,"");
        let params = "myPass=0x1a1aa1&table_id="+tableName;
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
            var url = './controller/TablesController.php';
            http.open('POST', url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function() 
            {
                if(http.readyState == 4 && http.status == 200) 
                {
                        if(http.responseText == 'success')
                        {
                            modal.style.display = "none";
                            location.reload();
                        }
                        else if(http.responseText == 'there')
                        {
                            alert("Bu Masadan Eklenmiş.");
                        }
                        else
                        {
                            alert("Eklenemedi.");
                        }
                }
            }
            http.send(params);
} 
</script>