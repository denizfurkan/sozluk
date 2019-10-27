<?php 
session_start();
include "../baglanti/db_baglan.php";

$mail = $_SESSION['email'];
$isimSoyisimTemp = $_POST["isimSoyisim"];
$isimSoyisim = strtolower($isimSoyisimTemp);
$dogumTarihi = $_POST["dogumTarihi"];
$cinsiyet = $_POST["cinsiyet"];


$bilgiGuncelle = "UPDATE kullanicilar SET isimSoyisim='$isimSoyisim', tarih='$dogumTarihi', cinsiyet='$cinsiyet' WHERE mail='$mail'"; 

$bilgiGuncelleSorgu = mysqli_query($baglan, $bilgiGuncelle);

if($bilgiGuncelleSorgu){
  
  $_SESSION['isimSoyisim']  =$isimSoyisim;
  $_SESSION['dogumTarihi']  =$dogumTarihi;
  $_POST["cinsiyet"] = $cinsiyet;
  
  echo '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-info animated fadeInDown" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;"><button onclick="this.parentElement.style.display=\'none\';this.parentElement.className=\'col-xs-11 col-sm-3 alert alert-info animated fadeOutDown\'" type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 100002;"><i class="icon-x"></i></button><span data-notify="icon" class="fas fa-check"></span><span data-notify="title">oldukça başarılı</span> <span data-notify="message">bilgileriniz pek güncel</span><a href="#" target="_blank" data-notify="url"></a></div>';
  
}
else{
  echo '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-danger" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; top: 30px; right: 30px;"><button onclick="this.parentElement.style.display=\'none\';this.parentElement.className=\'col-xs-11 col-sm-3 alert alert-info animated fadeOutDown\'" type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 100002;"><i class="icon-x"></i></button><span data-notify="icon" class="fas fa-exclamation-triangle"></span> <span data-notify="title">tüh olmadı</span> <span data-notify="message">bir takım hatalar içerisindeyiz</span><a href="#" target="_blank" data-notify="url"></a></div>';
}   

?>