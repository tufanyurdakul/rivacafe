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
    <title>Kidstown Riva</title>
</head>
<body>
     <div class="container">
        <div class="row h">
            <div class="col-12 center">
                <span class="c">Giriş Yap<span>
            </div>      
        </div>
        <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Daire No:<span>
            </div>
            <div class="col-7 ">
                <input class="c no"></input>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Şifre:<span>
            </div>
            <div class="col-7 ">
                <input type="password" class="c pass"></input>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 e">
                <button class="btn btn-success login">Giriş</button>
            </div>
            <div class="col-6 ">
                <button class="btn btn-danger signup">Üye Ol</button>
            </div>
        </div>
     </div>    
</body>
</html>
<script>
      let no = document.querySelector('.no');
      let pass = document.querySelector('.pass');
      let sign = document.querySelector('.signup');
      let login = document.querySelector('.login');
      sign.addEventListener('click',function(params){
        window.location.href = "./sign.php";
      });
      login.addEventListener('click',function(params){
          let val = no.value.toUpperCase();
        var http = new XMLHttpRequest();
            var url = './controller/login.php';
            var params = 'myPass=11000110&no='+val+'&pass='+pass.value;
            http.open('POST', url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function() 
            {
                if(http.readyState == 4 && http.status == 200) 
                {
                        if(http.responseText == 'login')
                        {
                           window.location.href="./panel.php";
                        }
                        else if(http.responseText == 'requestUser')
                        {
                            alert("Üyeliğiniz Onaylanma Sürecindedir.");
                        }
                        else if(http.responseText == 'not')
                        {
                            alert("Böyle Bir Üyelik Bulunamadı.");
                        }
                        else
                        {
                            alert(error);
                        }
                }
            }
            http.send(params); 
      });   
</script>   

