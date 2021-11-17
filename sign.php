<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./cs/index.css">
    <title>Üye Ol</title>
</head>
<body>
<div class="container">
        <div class="row" style="margin-top:100px;">
            <div class="col-12 center">
                <span class="c">Üye Ol<span>
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
                <span class="c">İsim:<span>
            </div>
            <div class="col-7 ">
                <input class="c name"></input>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Soyisim:<span>
            </div>
            <div class="col-7 ">
                <input class="c surname"></input>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-5 e">
                <span class="c">Telefon:<span>
            </div>
            <div class="col-7 ">
                <input class="c phone"></input>
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
                <button class="btn btn-success login">Giriş Yap</button>
            </div>
            <div class="col-2 ml-5">
                <button class="btn btn-danger signup">Üye Ol</button>
            </div>
        </div>
     </div>    
</body>
</html>
<script>
      let no = document.querySelector('.no');
      let name = document.querySelector('.name');
      let surname = document.querySelector('.surname');
      let phone = document.querySelector('.phone');
      let pass = document.querySelector('.pass');
      let sign = document.querySelector('.signup');
      let login = document.querySelector('.login');
      login.addEventListener('click',function(params){
        window.location.href = "./index.php";
      });
      sign.addEventListener('click',function(params){
        var http = new XMLHttpRequest();
            var url = './controller/signup.php';
            var params = 'myPass=01101100&no='+no.value.toUpperCase()+'&name='+name.value+'&surname='+surname.value+'&phone='+phone.value+'&pass='+pass.value;
            http.open('POST', url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function() 
            {
                if(http.readyState == 4 && http.status == 200) 
                {
                        if(http.responseText == 'inserted')
                        {
                           window.location.href="./index.php";
                        }
                        else if(http.responseText == 'number')
                        {
                            alert("Kullanıcı Kayıt İsteği 50 Den Fazla Olamaz.");
                        }
                        else if(http.responseText == 'registered')
                        {
                            alert("Bu Kullanıcı Zaten Sistemde Kayıtlı.");
                        }
                        else if(http.responseText == 'registered2')
                        {
                            alert("Bu Kullanıcı İçin Kayıt İsteği Gönderilmiştir.");
                        }
                        else
                        {
                            alert("Eklenemedi.");
                        }
                }
            }
            http.send(params); 
      });
      
</script>  