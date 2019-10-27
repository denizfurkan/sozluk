<?php 
session_start();
include "baglanti/db_baglan.php";


$id = $_GET["name"];
$kadi = $_SESSION["kullaniciAdi"];
$tarih = date('d.m.Y H:i');

    $sorgu = "INSERT INTO favoriler (entry_id,favlayan,tarih) VALUES('$id','$kadi','$tarih')";
    $sorgu_yap = mysqli_query($baglan,$sorgu);
       
        if($sorgu_yap){
            
       
        }else{
           
        }
    
    

?>