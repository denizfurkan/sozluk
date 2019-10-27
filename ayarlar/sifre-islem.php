<?php 
session_start();
include "../baglanti/db_baglan.php";

$email = $_SESSION['email'];

$sifre = $_POST["sifre"];
$yeniSifre = $_POST["yeniSifre"];
$yeniSifreTekrar = $_POST["yeniSifreTekrar"];

$sifreMD5 = md5($sifre);
$yeniSifreMD5 = md5($yeniSifre);

echo $yeniSifre;
echo $yeniSifreTekrar;

if(yeniSifre == yeniSifreTekrar){
  $sifreKontrol = "SELECT * FROM kullanicilar WHERE sifre= '$sifreMD5' AND mail='$email'";
  $sifreKontrolSorgu = mysqli_query($baglan, $sifreKontrol); 
  
  if(mysqli_num_rows($sifreKontrolSorgu) > 0){
    $sifreGuncelle = "UPDATE kullanicilar SET sifre='$yeniSifreMD5' WHERE mail='$email'"; 
    $sifreGuncelleSorgu = mysqli_query($baglan, $sifreGuncelle);
    
    echo '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-info animated fadeInDown" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;"><button onclick="this.parentElement.style.display=\'none\';this.parentElement.className=\'col-xs-11 col-sm-3 alert alert-info animated fadeOutDown\'" type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 100002;"><i class="icon-x"></i></button><span data-notify="icon" class="fas fa-check"></span><span data-notify="title">oldukça başarılı</span> <span data-notify="message">şifreniz pek güncel</span><a href="#" target="_blank" data-notify="url"></a></div>';
  }
  
  else{
    echo '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;"><button onclick="this.parentElement.style.display=\'none\';this.parentElement.className=\'col-xs-11 col-sm-3 alert alert-info animated fadeOutDown\'" type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 100002;"><i class="icon-x"></i></button><span data-notify="icon" class="fas fa-exclamation-triangle"></span> <span data-notify="title">tüh olmadı</span> <span data-notify="message">bir takım hatalar içerisindeyiz</span><a href="#" target="_blank" data-notify="url"></a></div>';
  }
}else{
  echo '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;"><button onclick="this.parentElement.style.display=\'none\';this.parentElement.className=\'col-xs-11 col-sm-3 alert alert-info animated fadeOutDown\'" type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 100002;"><i class="icon-x"></i></button><span data-notify="icon" class="fas fa-exclamation-triangle"></span> <span data-notify="title">tüh olmadı</span> <span data-notify="message">şifreler birbirini tutmuyor. tekrar denemelisin</span><a href="#" target="_blank" data-notify="url"></a></div>';
}

?>