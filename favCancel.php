<?php 
session_start();
include "baglanti/db_baglan.php";


$id = $_GET["name"];
$kadi = $_SESSION["kullaniciAdi"];

    $sorgu = "DELETE FROM favoriler where entry_id='$id' AND favlayan='$kadi'";
    $sorgu_yap = mysqli_query($baglan,$sorgu);
       
        if($sorgu_yap){
            
        }else{
           
        }
    
    

?>