<?php 
session_start();
include "../baglanti/db_baglan.php";
$tarih = date('d.m.Y H:i');
$gonderen = $_SESSION["kullaniciAdi"];
$ip = $_SESSION["ip"];
$yazi = $_POST["mesaj"];
$kime = $_POST["gonderilen"];

$mesajSorgu = "INSERT INTO mesajlar (gonderici, alici, mesaj, tarih, ip)
                                        VALUES ('$gonderen', '$kime', '$yazi', '$tarih', '$ip');";
                $mesajSorguYap = mysqli_query($baglan,$mesajSorgu);
                                        
                if($mesajSorguYap){
                    
                }
                
                
?>