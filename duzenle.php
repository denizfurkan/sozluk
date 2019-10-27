<?php 
session_start();
include "baglanti/db_baglan.php";
$kadi = $_SESSION["kullaniciAdi"];
$entry = $_GET["entry"];
?>

<html>
<head>  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes, minimal-ui">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  <meta property="og:image" content="images/kodcularSozlukLogo.png">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  
  <!-- Document title -->
  <title>sözlük | kodcular</title>
  
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
</head>
<body>
  
  <script src="js/jquery.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="js/plugins.js"></script>
  
  <!--Template functions-->
  <script src="js/functions.js"></script> 
  
  <?php include "header.php";?>
  
  <hr class="space">
  
  <div class="genel">
    
        
        <?php 
        include "sol-nav.php";
          ?>  
        
     <style>
         
         .genel{
             left: 15;
         }
         
     </style>
      
      <div class="orta">
        
        <?php 
        $icerikSorgu = "SELECT * FROM entryler where id='$entry'";
        $icerikSorguYap = mysqli_query($baglan,$icerikSorgu);
        
        $row = mysqli_num_rows($icerikSorguYap);
        
        if($icerikSorguYap){
            
            $satirSay = mysqli_fetch_array($icerikSorguYap);
            $entry_icerik = $satirSay["entry"];
            $yazan = $satirSay["kullaniciAdi"];
            
            if($kadi == $yazan){
                
          
            
            
            ?>
            <head><meta name="description" content="<?php echo $entry?>"></head>
            <div class="content-entry">
              <a class="baslik"><h4>Düzenleme Sayfasi</h4></h4></a>
              <br>
              <form method="POST">
              <textarea name="yeniEntry" style="width: 500px;height: 200px;border: 1px solid #dee2e6;padding:10px;"><?php echo $entry_icerik;?></textarea>
              <br>
              <br>
              <button class="btn btn-icon-holder btn-shadow btn-outline btn-rounded" style="text-transform:lowercase;" type="submit">düzelt bakam <i class="fa fa-edit"></i></button>
              </form>
              <br>
              <br>
              
              <?php 
              
                if($_POST){
                    $tarih = date('d.m.Y H:i');
                    $yeniYazi = $_POST["yeniEntry"];
                    
                    $sorgu = "UPDATE entryler SET entry = '$yeniYazi', tarih= '$tarih' WHERE id='$entry'";
                    
                    if(mysqli_query($baglan,$sorgu)){
                        header("Location: http://sozluk.codingtr.com/entry/$entry");
                    }
                    
                }
              
              
              ?>
              
              
             
            </div>
            
            <?php 
            
            }else{
               header("location: http://sozluk.codingtr.com");
                
            }
            ?>
            <hr class="space">
            
          
           
            <?php
            
            
            
            
          
          
        }
        ?>
        
        
        
        
      </div>
     
      
     
      
    </div>    
  </body>
  
   <?php 
      
      include "footer.php";
      
      ?>
  
  </html>