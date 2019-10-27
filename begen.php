<?php 
session_start();
include "baglanti/db_baglan.php";


$id = $_GET["name"];
$kadi = $_SESSION["kullaniciAdi"];
$tarih = date('d.m.Y H:i');

    $sorgu = "INSERT INTO begeni (entry_id,begenen,tarih) VALUES('$id','$kadi','$tarih')";
    $sorgu_yap = mysqli_query($baglan,$sorgu);
       
        if($sorgu_yap){
            $sorgu = "DELETE FROM dislike where entry_id='$id' AND dislike_atan='$kadi'";
            $sorgu_yap = mysqli_query($baglan,$sorgu);
       
        }else{
           
        }
    
    

?>