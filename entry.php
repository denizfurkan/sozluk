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
        $icerikSorgu = "SELECT * FROM entryler where id='$entry' LIMIT 5";
        $icerikSorguYap = mysqli_query($baglan,$icerikSorgu);
        
        $row = mysqli_num_rows($icerikSorguYap);
        
        if($icerikSorguYap){
            $satirSay = mysqli_fetch_array($icerikSorguYap);
            $entry_id= $satirSay["id"];
            $entry_kadi = $satirSay["kullaniciAdi"];
            $entry_baslik = $satirSay["baslik"];
            $entry = $satirSay["entry"];
            $entry_tarih = $satirSay["tarih"];
            
          $begeniSorgu = "SELECT * FROM begeni where entry_id = '$entry_id' AND begenen='$kadi'";
          $begeniSorguYap= mysqli_query($baglan,$begeniSorgu);
          
          $dislikeSorgu = "SELECT * FROM dislike where entry_id = '$entry_id' AND dislike_atan ='$kadi'";
          $dislikeSorguYap = mysqli_query($baglan,$dislikeSorgu);
          
          $favSorgu = "SELECT * FROM favoriler where entry_id = '$entry_id' AND favlayan='$kadi'";
          $favSorguYap = mysqli_query($baglan,$favSorgu);
          
          
          $totalFavSorgu = "SELECT * FROM favoriler where entry_id='$entry_id'";
          $totalFavSorguYap = mysqli_query($baglan,$totalFavSorgu);
          $totalFavSayisi = mysqli_num_rows($totalFavSorguYap);
            
            ?>
            <head><meta name="description" content="<?php echo $entry?>"></head>
            <div class="content-entry">
              <a class="baslik" href="http://sozluk.codingtr.com/s/<?php echo $entry_baslik;?>"><h4><?php echo $entry_baslik?></h4></h4></a>
              <br>
              
              <?php echo $entry?>
              
              <br>
              <br>
              
              <div class="entry-footer">
                <div class="fb-share-button" data-href="http://sozluk.codingtr.com" data-layout="button_count" data-size="small"><a target="_target" data-toggle="tooltip" data-placement="top" title="ficide paylaş" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://sozluk.codingtr.com/entry/'.$entry_id;?>" class="face"><i class="fab fa-facebook-f"></i></a></div>
                &nbsp&nbsp
                <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $entry;?> <?php echo 'http://sozluk.codingtr.com/entry/'.$entry_id;?>" class="twitter" data-toggle="tooltip" data-placement="top" title="tivitle beni"><i class="fab fa-twitter"></i></a>
                &nbsp&nbsp&nbsp&nbsp
                <?php if($_SESSION["online"])
                {
                  
                  ?>
                  <a href="javascript:;" id="begen<?php echo$i;?>"   class="like" data-toggle="tooltip" data-placement="top" title="beğendim"><i class="icon-thumbs-up11"></i></a>
                  &nbsp&nbsp
                  <a href="javascript:;" id="begenme<?php echo$i;?>" class="dislike" data-toggle="tooltip" data-placement="bottom" title="beğenmedim"><i class="icon-thumbs-down11"></i></a>
                  &nbsp&nbsp
                  <a href="javascript:;"             id="fav<?php echo$i;?>"     class="fav" data-toggle="tooltip" data-placement="bottom" title="çok ii"><i class="fas fa-heart"></i></a>&nbsp<span class="fav-sayi"><?php echo $totalFavSayisi;?></span>
                  
                  <?php 
                  
                }
                ?>
                <div class="sag-foter" style="float: right;">
                  
                  <a href=""><?php echo $entry_tarih;?></a> <a style="color:#007fae" href="http://sozluk.codingtr.com/yazar/<?php echo $entry_kadi;?>"><?php echo $entry_kadi;?></a>
                  
                </div>
                
              </div>
            </div>
            <hr class="space">
            <?php 
            
            if(mysqli_num_rows($begeniSorguYap) > 0){
              echo "<script>
              
              $('#begen".$i."').css('color', 'blue');
              $('#begen".$i."').attr('title','vazgeçtim');
              $('#begen".$i."').attr('id', 'begenmektenVazgec".$i."');

              
              
              </script>";
              
          }
          
          
          if(mysqli_num_rows($dislikeSorguYap) > 0){
              
              echo "<script>
              
              $('#begenme".$i."').css('color', 'red');
              $('#begenme".$i."').attr('title','iyiymis yav');
              $('#begenme".$i."').attr('id', 'dislikeCancel".$i."');

              
              
              </script>";
              
          }
          
          if(mysqli_num_rows($favSorguYap) > 0){
              
               echo "<script>
              
              $('#fav".$i."').css('color', 'pink');
              $('#fav".$i."').attr('title','sarmadı');
              $('#fav".$i."').attr('id', 'favCancel".$i."');

              
              
              </script>";
              
          }
          
            
            ?>
            
             <script>
                   
                   
                   //BEGENİ İÇİN SCRIPT
                   
                  $('#begen<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/begen.php',
                          data:'name='+name,
                          success: function(data){
                              $('#begen<?php echo $i;?>').css('color', 'blue');
                              $('#begen<?php echo $i;?>').attr('title','vazgeçtim');    
                              $('#begen<?php echo $i;?>').attr('id', 'begenmektenVazgec<?php echo $i;?>');
                              
                               $.ajaxSetup ({
                                cache: false
                            });
                            var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />"; 
                              $("body").load(document.URL);
                          }
                      })
                  })
                   
                  
                   $('#begenmektenVazgec<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/begenmektenVazgec.php',
                          data:'name='+name,
                          success: function(data){
                              $('#begenmektenVazgec<?php echo $i;?>').css('color', '#b0bec5');
                              $('#begenmektenVazgec<?php echo $i;?>').attr('title','beğendim');    
                              $('#begenmektenVazgec<?php echo $i;?>').attr('id', 'begen<?php echo $i;?>');
                               $.ajaxSetup ({
                            cache: false
                        });
                        var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />";     
                              $("body").load(document.URL);
                              
                              
                          }
                      })
                  })                 
                   //BEGENİ İÇİN SCRIPT BİTİŞ
                   
                       //DISLIKE İÇİN SCRIPT
                 
                 
                   $('#begenme<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/begenme.php',
                          data:'name='+name,
                          success: function(data){
                              $('#begenme<?php echo $i;?>').css('color', 'red');
                              $('#begenme<?php echo $i;?>').attr('title','iyiymiş yav');    
                              $('#begenme<?php echo $i;?>').attr('id', 'dislikeCancel<?php echo $i;?>');
                              
                               $.ajaxSetup ({
                                cache: false
                            });
                            var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />"; 
                              $("body").load(document.URL);
                          }
                      })
                  })
                   
                  
                   $('#dislikeCancel<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/dislikeCancel.php',
                          data:'name='+name,
                          success: function(data){
                              $('#dislikeCancel<?php echo $i;?>').css('color', '#b0bec5');
                              $('#dislikeCancel<?php echo $i;?>').attr('title','beğenmedim');    
                              $('#dislikeCancel<?php echo $i;?>').attr('id', 'begenme<?php echo $i;?>');
                               $.ajaxSetup ({
                            cache: false
                        });
                        var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />";     
                              $("body").load(document.URL);
                              
                              
                          }
                      })
                  })                 
                   
                   //DISLIKE İÇİN SCRIPT BİTİŞ
                   
                   
                   
                   //FAV İÇİN SCRIPT
                   
                     $('#fav<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/fav.php',
                          data:'name='+name,
                          success: function(data){
                              $('#fav<?php echo $i;?>').css('color', 'pink');
                              $('#fav<?php echo $i;?>').attr('title','sardı');    
                              $('#fav<?php echo $i;?>').attr('id', 'favCancel<?php echo $i;?>');
                              
                               $.ajaxSetup ({
                                cache: false
                            });
                            var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />"; 
                              $("body").load(document.URL);
                          }
                      })
                  })
                   
                  
                   $('#favCancel<?php echo $i;?>').click(function(){
                      
                      var name = '<?php echo $entry_id;?>';
                      
                      $.ajax({
                          
                          url: 'http://sozluk.codingtr.com/favCancel.php',
                          data:'name='+name,
                          success: function(data){
                              $('#favCancel<?php echo $i;?>').css('color', '#b0bec5');
                              $('#favCancel<?php echo $i;?>').attr('title','sarmadı');    
                              $('#favCancel<?php echo $i;?>').attr('id', 'fav<?php echo $i;?>');
                               $.ajaxSetup ({
                            cache: false
                        });
                        var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...' />";     
                              $("body").load(document.URL);
                              
                              
                          }
                      })
                  })                 
                   
                   //FAV İÇİN SCRIPT BİTİŞ
              
                   
                   
                   
                   
               </script>
            
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