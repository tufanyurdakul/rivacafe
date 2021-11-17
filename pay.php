<?php
include("./controller/pay.php");
$data = json_decode($mydata); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Hesap Dökümü</title>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row">
            <div class="col-3 pt-5" style="height:200vh;background-color:red; ">
                    <?php include("header.php"); ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12" style="text-align:center;">
                    <h3>HESAP DÖKÜMÜM</h3>
                    </div>
               
                </div>
                <div class="row">
                <div class="col-12 mt-3 mb-3 mr-2" style="text-align:center;">
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
                            <th scope="col"> <?php echo $item->d; ?> </td> 
                            <th scope="col">  <?php echo $item->c; ?> </td> 
                            <th scope="col"> <?php echo $item->mname; ?> </td> 
                            <th scope="col"> %<?php echo $item->reduce; ?></td> 
                            <th scope="col"> <?php echo $item->price; ?> TL </td>
                            <th scope="col"> <?php echo ($item->price * $item->c)-((($item->price * $item->c)*$item->reduce)/100); ?> TL </td> 
                            </tr>
                            <?php endforeach ?>
                        </tbody>     
                    </table> 
                     
            </div>
          </div>                
                </div>
               
            </div>
        </div>
    </div>

                
</body>
</html>