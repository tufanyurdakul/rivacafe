<?php 
session_start();
include("./controller/FoodController.php");
$data = json_decode($mydata); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cs/index.css">
    <link rel="stylesheet" href="./cs/modal.css">
    <title>Yemekler</title>
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
                            <p>Isim:</p>
                        </div>
                        <div class="col-8">
                            <input class="name"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Fiyat:</p>
                        </div>
                        <div class="col-8">
                            <input class="price"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Cins:</p>
                        </div>
                        <div class="col-8">
                            <input class="type"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Stok:</p>
                        </div>
                        <div class="col-8">
                            <input class="stock"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>Indirim(%):</p>
                        </div>
                        <div class="col-8">
                            <input class="reduce"></input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn canceled" style="background-color:black;"><i class="fa fa-times" aria-hidden="true" style="color:red;"></i></button>  
                <button class="btn deleted" style="background-color:black;"><i class="fa fa-check" aria-hidden="true" style="color:green;"></i></button>
                </div>
            </div>
</div>
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
<div class="container-fluid p-0">
        <div class="row">
        <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
                <?php include("header.php"); ?>
            </div>
            <?php if($_SESSION["accessable"]==1): ?>

        <div class="col-9">
            <div class="col-2">
                <div class="row mb-3 mt-3">
                    <button class = "btn btn-warning w-100"><i class="fas fa-hamburger ml-2"></i><i class="fa fa-plus ml-2" aria-hidden="true"></i></button>
                </div>
            </div>
                    <table class="table">
                        <thead>
                            <tr> 
                                <th> ID </td>
                                <th> İSMİ </td>
                                <th> FİYAT </td>
                                <th> STOK </td>
                                <th> İNDİRİM </td>
                                <th> CİNS </td>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php foreach($data as $item): ?>
                            <tr>
                            <th scope="col"> <?php echo $item->id; ?> </td> 
                            <th scope="col"> <?php echo $item->food_name; ?> </td> 
                            <th scope="col"> <?php echo $item->food_price; ?> TL</td> 
                            <th scope="col"> <?php echo $item->food_stock; ?> </td>
                            <th scope="col"> %<?php echo $item->food_reduce; ?> </td>
                            <th scope="col"> <?php echo $item->food_type; ?> </td>
                            <th scope="col b"> <button class="btn btn-primary mr-2"><i class="fas fa-edit"></i></button><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>     
                    </table> 
                      
            </div>
            <?php elseif($_SESSION["accessable"] == 0): ?>
                <?endif ?> 
        </div>
    </div>
</body>
</html>
<script>
    let choosen = 0;
    let id = 0;
    let food_type = document.querySelector('.type');
    let addItem = document.querySelector('.btn-warning');
    let btnEdit = document.querySelectorAll('.btn-primary');
    let btnDelete = document.querySelectorAll('.btn-danger');
    let modal = document.querySelector('.modal');
    let modal2 = document.querySelector('.modal2');
    let name = document.querySelector('.name');
    let info = document.querySelector('.info');
    let price = document.querySelector('.price');
    let stock = document.querySelector('.stock');
    let sale = document.querySelector('.reduce');
    let addOrUpItem = document.querySelectorAll('.deleted')[0];
    let deleteItem = document.querySelectorAll('.deleted')[1];
    let scopes = document.querySelector('.table');
    let sure = document.querySelectorAll('.sure')[0];
    let sure2 = document.querySelectorAll('.sure')[1];
    let btnCancel = document.querySelectorAll('.canceled')[0];
    let span = document.querySelectorAll('.close')[0];
    let btnCancel2 = document.querySelectorAll('.canceled')[1];
    let span2 = document.querySelectorAll('.close')[1];
    addItem.addEventListener('click',function(params){
        modal.style.display = "block";
        choosen = 1;
    });
    btnEdit.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal.style.display = "block";
            sure.innerHTML = scopes.rows[idx+1].cells[1].innerHTML+" Adlı Yemeğin Düzenlemesi";
            name.value = scopes.rows[idx+1].cells[1].innerHTML.replace(/\s/g,"");
            price.value = scopes.rows[idx+1].cells[2].innerHTML.replace(/\s/g,"").replace("TL","");
            stock.value = scopes.rows[idx+1].cells[3].innerHTML.replace(/\s/g,"");
            sale.value = scopes.rows[idx+1].cells[4].innerHTML.replace(/\s/g,"").replace("%","");
            food_type.value = scopes.rows[idx+1].cells[5].innerHTML.replace(/\s/g,"").replace("%","");
            choosen = 2;
            id = scopes.rows[idx+1].cells[0].innerHTML;
        });
    });
    btnDelete.forEach(function (item, idx) {
        item.addEventListener('click', function () {
            modal2.style.display = "block";
            sure2.innerHTML = scopes.rows[idx+1].cells[1].innerHTML+" Adlı Yemeğin Silinmesi";
            info.innerHTML = "ID'si "+scopes.rows[idx+1].cells[0].innerHTML+" olan "+scopes.rows[idx+1].cells[1].innerHTML+" Adlı Yemeğin Silinmesini İstiyor Musun?";
            id = scopes.rows[idx+1].cells[0].innerHTML;
            choosen = 3;
        });
    });
       addOrUpItem.addEventListener('click',function(params){
        if(choosen == 1)
        {
            var params = 'myPass=11001010&name='+name.value+'&price='+price.value+'&stock='+stock.value+'&sale='+sale.value+'&food_type='+food_type.value;
            sendRequest(params);            
        }
        else if(choosen == 2)
        {
            let food_name = name.value;
            let food_price = price.value;
            let food_stock = stock.value;
            let food_onSale = sale.value;
            let food_types = food_type.value.replace(/\s/g,"");

            var params = 'myPass=xa100axxa&id='+id+'&name='+food_name+'&price='+food_price+
            '&stock='+food_stock+'&sale='+food_onSale+'&food_type='+food_types;
            sendRequest(params);
        }
    });
    deleteItem.addEventListener('click',function(params){
        if(choosen == 3)
        {
            var params = 'myPass=xxxxxxxxxx&id='+id;
            sendRequest(params);
        }
    });
    window.onclick = function(event)
    {
        if (event.target == modal)
        {
            modal.style.display = "none";
        }
        else if (event.target == modal2)
        {
            modal2.style.display = "none";
        }
    }
    btnCancel.onclick = function()
    {
        modal.style.display = "none";  
    }
    span.onclick = function()
    {
        modal.style.display = "none";
    }  
    btnCancel2.onclick = function()
    {
        modal2.style.display = "none";  
    }
    span2.onclick = function()
    {
        modal2.style.display = "none";
    }
function sendRequest(params)
{
    var http = new XMLHttpRequest();
            var url = './controller/FoodController.php';
            
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
                            alert("Bu Yemekten Eklenmiş.");
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