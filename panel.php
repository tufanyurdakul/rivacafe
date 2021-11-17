<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title><?php if($_SESSION["accessable"] == 1): ?>
            <?php echo "Yönetici Paneli"; ?>
            <?php elseif($_SESSION["accessable"] == 0): ?>
            <?php echo "Kullanıcı Paneli"; ?>
            <?php endif ?>
    </title>
</head>
<body>
    <div class="container-fluid p-0">
    <div class="row">
            <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
                    <?php include("header.php"); ?>
            </div>
            <div class="col-9">
                <h3 style="text-align:center">DUYURULAR</h3>
            </div>
        </div>
    </div>
        
            
</body>
</html>
<script>

</script>