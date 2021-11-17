<?php 
session_start();
include("./controller/RequestController.php");
$data = json_decode($mydata); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./cs/modal.css">
    <title>Üyelik İstekleri</title>
</head>
<body>
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
        <div class="col-9">
            <?php if($_SESSION["accessable"]==1): ?>
            <table class="table">
                <thead>
                    <tr> 
                        <th> ID </td>
                        <th> DAIRE NO</td>
                        <th> ISIM </td>
                        <th> SOYISIM </td>
                        <th> TELEFON </td>
                    </tr>
                </thead>
                <tbody>    
                    <?php foreach($data as $item): ?>
                    <tr>
                        <th scope="col"> <?php echo $item->id; ?> </td> 
                        <th scope="col"> <?php echo $item->home_no; ?> </td> 
                        <th scope="col"> <?php echo $item->username; ?> </td> 
                        <th scope="col"> <?php echo $item->surname; ?> </td> 
                        <th scope="col"> <?php echo $item->phone; ?> </td>
                        <th scope="col b"> <button class="btn btn-danger mr-2"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>     
            </table> 
            <?php elseif($_SESSION["accessable"] == 0): ?>
            <?endif ?>        
        </div>
    </div>
</div>
<script>
         let deleteOrAdd = 0;
         let id = 0;
         let deleteButton = document.querySelectorAll('.btn-danger');
         let add = document.querySelectorAll('.btn-success');
         let scopes = document.querySelector('.table');
         let info = document.querySelector('.info');
         var modal = document.querySelector('.modal');
         var span = document.getElementsByClassName("close")[0];
         let sure = document.querySelector('.sure');
         let okey = document.querySelector('.deleted');
         let canceled = document.querySelector('.canceled');
        deleteButton.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[1].innerHTML + " Daire İsteğini Silmek"
            info.innerHTML = "ID'si "+scopes.rows[idx+1].cells[0].innerHTML+" olan "+scopes.rows[idx+1].cells[1].innerHTML
            +" bloğunun üyelik alma isteğini silmek ister misiniz?";
            deleteOrAdd = 1;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    add.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[1].innerHTML + " Daire İsteğini Eklemek"
            info.innerHTML = "ID'si "+scopes.rows[idx+1].cells[0].innerHTML+" olan "+scopes.rows[idx+1].cells[1].innerHTML
            +" bloğunun üyelik alma isteğini kabul etmek ister misiniz ?";
            deleteOrAdd = 2;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    okey.addEventListener('click', function ()
    {
        if(deleteOrAdd == 1)
        {
            var params = 'myPass=11111111&id='+id;
            sendRequest(params);
        }
        else if(deleteOrAdd == 2)
        {
            var params = 'myPass=11111110&id='+id;
            sendRequest(params);
        }
    });
span.onclick = function()
{
    modal.style.display = "none";
}
canceled.onclick = function()
{
    modal.style.display = "none";
}
window.onclick = function(event)
{
    if (event.target == modal)
    {
        modal.style.display = "none";
    }
}
function sendRequest(params)
{
    var http = new XMLHttpRequest();
            var url = './controller/RequestController.php';
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
                        else
                        {
                            alert("Eklenemedi.");
                        }
                }
            }
            http.send(params);
}       
</script>  
</body>
</html>
  