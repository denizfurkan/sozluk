<?php 
session_start();
include "baglanti/db_baglan.php";
$kadi = $_SESSION["kullaniciAdi"];
?>

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <link href="/css/plugins.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/kisi-nav.css" rel="stylesheet">
</head>
    
   <body>
       <div class="yazarlar">
           
           
           
           
           
       <ul class="list-icon list-icon-colored">
           
           
           <?php 
           
            $sonMesajSorgu = "SELECT distinct gonderici FROM mesajlar WHERE alici = '$kadi'";
            $sonMesajSorguYap= mysqli_query($baglan,$sonMesajSorgu);
            $sonMesajSorguSayisi = mysqli_num_rows($sonMesajSorguYap);
            
                for($i=0;$i<$sonMesajSorguSayisi;$i++){
                    $row = mysqli_fetch_array($sonMesajSorguYap);
                    $gonderici = $row["gonderici"];
                    $rest = substr($mesaj, "0", "17");
                        
                    
                    
                    echo '<a href="sa"><li><i class="fa fa-user"></i>'.$gonderici.'</li></a>';
                    
                    
                    
                    
                }
            
           
           ?>
           
                            
                            
                        </ul>
      
       </div>
       
       
   </body> 
</html>
    

    
    


