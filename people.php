<?php 
session_start();
include("./controller/PeopleController.php");
$data = json_decode($mydata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./cs/index.css">
    <link rel="stylesheet" href="./cs/modal.css">
    <title>Kullanıcılar</title>
</head>
<body>
<div class="modal2">
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
<div class="modal">
            <div class="modal-content">
                <div class="modal-header">
                        <h2 class="sure"></h2>
                        <span class="close">&times;</span>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <p>Daire:</p>
                        </div>
                        <div class="col-8">
                            <input class="home"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>İsim:</p>
                        </div>
                        <div class="col-8">
                            <input class="name"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Soyisim:</p>
                        </div>
                        <div class="col-8">
                            <input class="surname"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Telefon:</p>
                        </div>
                        <div class="col-8">
                            <input class="phone"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Yetki:</p>
                        </div>
                        <div class="col-8">
                            <select class="access">
                                <option value="0">Kullanıcı</option>
                                <option value="1">Admin</option>
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
                                <th> YETKİ </td>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php foreach($data as $item): ?>
                            <tr>
                            <th scope="col"> <?php echo $item->id; ?> </td> 
                            <th scope="col"> <?php echo $item->home_no; ?> </td> 
                            <th scope="col"> <?php echo $item->name; ?> </td> 
                            <th scope="col"> <?php echo $item->surname; ?> </td> 
                            <th scope="col"> <?php echo $item->phone; ?> </td>
                            <th scope="col"> <?php echo $item->access == 1 ? 'Admin' : 'Kullanıcı'; ?> </td>
                            <th scope="col b"> <button class="btn btn-primary mr-2"><i class="fas fa-edit"></i></button><button class="btn btn-success mr-2"><i class="fas fa-eye"></i></button><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>     
                    </table> 
                <?php elseif($_SESSION["accessable"] == 0): ?>
                <?endif ?>        
            </div>
        </div>
    </div>  
</body>
</html>
<script>
let id = 0;
     let choosen = 0;
     var span = document.getElementsByClassName("close")[1];
     var span2 = document.getElementsByClassName("close")[0];
     let info = document.querySelector('.info');
     let btnEdit = document.querySelectorAll('.btn-primary');
     let btnShow = document.querySelector('.btn-success');
     let btnDelete = document.querySelectorAll('.btn-danger');
     var modal = document.querySelector('.modal');
     var modal2 = document.querySelector('.modal2');
     let sure = document.querySelector('.sure');
     let scopes = document.querySelector('.table');
     let homeNo = document.querySelector('.home');
     let name = document.querySelector('.name');
     let surname = document.querySelector('.surname');
     let phone = document.querySelector('.phone');
     let access = document.querySelector('.access');
     let okey = document.querySelectorAll('.deleted')[1];
     let okey2 = document.querySelectorAll('.deleted')[0];
     let canceled = document.querySelectorAll('.canceled')[1];
     let canceled2 = document.querySelectorAll('.canceled')[0];
     let showPeople = document.querySelectorAll('.btn-success');
     btnEdit.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[1].innerHTML + " Daire Düzenlemesi";
            homeNo.value = scopes.rows[idx+1].cells[1].innerHTML.replace(/\s/g,"");
            name.value = scopes.rows[idx+1].cells[2].innerHTML.replace(/\s/g,"");
            surname.value = scopes.rows[idx+1].cells[3].innerHTML.replace(/\s/g,"");
            phone.value = scopes.rows[idx+1].cells[4].innerHTML.replace(/\s/g,"");
            let accessable = scopes.rows[idx+1].cells[5].innerHTML.replace(/\s/g,"");
            if(accessable.replace(/\s/g,"")=="Kullanıcı")
            {
                access.value = 0;
            }
            else
            {
                access.value = 1;
            }
            choosen = 1;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    showPeople.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            id = scopes.rows[idx+1].cells[0].innerHTML;
            let home = scopes.rows[idx+1].cells[1].innerHTML;
            let name = scopes.rows[idx+1].cells[2].innerHTML;
            let surname = scopes.rows[idx+1].cells[3].innerHTML;
            document.cookie = "id = "+id;
            document.cookie = "home = "+home;
            document.cookie = "name = "+name;
            document.cookie = "surname = "+surname;
            location.href = "./showPeople.php";
        });
    });
    btnDelete.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal2.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[1].innerHTML + " Daire Silinmesi";
            info.innerHTML = "ID'si "+scopes.rows[idx+1].cells[0].innerHTML+" olan "+scopes.rows[idx+1].cells[1].innerHTML
            +" dairesini silmek ister misiniz?";
            choosen = 3;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    okey.addEventListener('click',function(params){
        if(choosen == 1)
        {
            var params = 'myPass=00000000&id='+id+'&no='+homeNo.value.toUpperCase()+'&name='+name.value+'&surname='+surname.value+
            '&phone='+phone.value+'&access='+access.value;
            sendRequest(params);
           
        }
    });
    okey2.addEventListener('click',function(params){
         if(choosen == 3)
        {
            var params = 'myPass=01010101&id='+id;
            sendRequest(params);
        }
    });
    span.onclick = function()
    {
        modal.style.display = "none";
    }
    span2.onclick = function()
    {
        modal2.style.display = "none";
    }
    canceled.onclick = function()
    {
            modal.style.display = "none";  
    }
    canceled2.onclick = function()
    {
            modal2.style.display = "none";  
    }
    window.onclick = function(event)
    {
        if (event.target == modal)
        {
            modal.style.display = "none";
        }
        if(event.target == modal2)
        {
            modal2.style.display = "none";
        }
    }
    function sendRequest(params)
    {
        var http = new XMLHttpRequest();
            var url = './controller/PeopleController.php';
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
                            alert(http.responseText);
                        }
                }
            }
            http.send(params);
    }
</script>  