<?php 
session_start();
include "baglanti/db_baglan.php";
$kadi = $_SESSION["kullaniciAdi"];
$id = $_GET["id"];
?>

<html>
<head>  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes, minimal-ui">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <meta property="og:image" content="images/kodcularSozlukLogo.png">
  <meta name="description" content="teknolojik sözlük">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  
  <!-- Document title -->
  <title>mesajlaşma | kodcular</title>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="css/plugins.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">
  <link href="css/sozluk.css" rel="stylesheet">
  <link href="css/message.css" rel="stylesheet">
</head>
  
  <body style = "overflow-y:scroll; overflow-x:hidden;">
 
      <script>
       
     var timer= 10;
      
        
            function inTime(){
                setTimeout(inTime,1000);
                
                if(timer == 2){
                    
                    
                    timer = 11;
                    clearTimeout(inTime);
                    $("body").load(document.URL);
                }
                
                timer--;
                
            }
            
            inTime();
      </script>
      
<div id="chat" class="chat">
    
         
      <?php 
      
        $mesajlarSorgu = "(SELECT * FROM mesajlar WHERE gonderici = '$kadi' AND alici= '$id') UNION(SELECT * FROM mesajlar WHERE gonderici = '$id' AND alici= '$kadi') ORDER BY tarih ASC";
        $mesajlarSorguYap = mysqli_query($baglan,$mesajlarSorgu);
        $mesajlarSorguSayisi = mysqli_num_rows($mesajlarSorguYap);
        if($mesajlarSorguSayisi > 0){
            
            while($row = mysqli_fetch_array($mesajlarSorguYap)){
                $gonderici = $row["gonderici"];
                $alici = $row["alici"];
                $mesaj = $row["mesaj"];
                $tarih =$row["tarih"];
                
                if($alici == $kadi){
                    
                    echo '<div class="yours messages">
                            <div class="message">
                                    '.$mesaj.'
                            </div>
                          </div>';
                    
                }else{
                
                echo '<div class="mine messages">
                    <div class="message">
                      '.$mesaj.'
                    </div>
                    </div>';
                }
                
            }
 
        }
        
      ?>
    
 
  
</div>
  <script>
  window.scrollTo(0,document.body.scrollHeight);
  </script>
  </body>
  
  </html>