<?php

$sunucu = "";
$sifre = "";
$veritabani = "";
$kullanici = "";

$baglan = mysqli_connect($sunucu,$kullanici, $sifre, $veritabani);
$baglan->set_charset("utf8");

  if(!$baglan){
   echo "Baglanti bozuk.";
  }

 ?>
