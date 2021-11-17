<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cs/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Şifre Güncelle</title>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row">
            <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
                    <?php include("header.php"); ?>
            </div>
            <div class="col-9">
            <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Mevcut Şifren:<span>
            </div>
            <div class="col-7 ">
                <input type="password" class="c pass"></input>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Yeni Şifren:<span>
            </div>
            <div class="col-7 ">
                <input type="password" class="c passnew"></input>
            </div>
        </div>
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6 mt-5 e">
                <button class="btn btn-success change w-100">Değiştir</button>
            </div>
            <div class="col-3">

            </div>
        </div>
            </div>
        </div>
    </div>
        
      
</body>
</html>
<script>
      let pass = document.querySelector('.pass');
      let passnew = document.querySelector('.passnew');
      let change = document.querySelector('.change');
      
      change.addEventListener('click',function(params){
          let oldPass = pass.value;
          let newPass = passnew.value;
        var http = new XMLHttpRequest();
            var url = './controller/signup.php';
            var params = 'myPass=aaaa&old_pass='+oldPass+'&new_pass='+newPass;
            http.open('POST', url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function() 
            {
                if(http.readyState == 4 && http.status == 200) 
                {
                        if(http.responseText == 'wrong')
                        {
                            alert("Eski Parolanızı Yanlış Girdiniz.");
                        }
                        else if(http.responseText == 'success')
                        {
                            alert("Şifreniz Değiştirilmiştir.");
                            pass.value = "";
                            passnew.value = "";
                        }
                        else
                        {
                            alert("Değiştirilemedi");
                        }
                }
            }
            http.send(params); 
      });   
</script>   

