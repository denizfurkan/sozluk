<?php 
session_start();
include "baglanti/db_baglan.php";


$id = $_GET["name"];
$kadi = $_SESSION["kullaniciAdi"];
$tarih = date('d.m.Y H:i');

    $sorgu = "INSERT INTO dislike (entry_id,dislike_atan,tarih) VALUES('$id','$kadi','$tarih')";
    $sorgu_yap = mysqli_query($baglan,$sorgu);
       
        if($sorgu_yap){
            $sorgu = "DELETE FROM begeni where entry_id='$id' AND begenen='$kadi'";
            $sorgu_yap = mysqli_query($baglan,$sorgu);
        }else{
           
        }
    
    

?>