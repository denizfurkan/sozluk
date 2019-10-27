<?php 
session_start();
$paramTemp = strtolower($_GET["q"]);
$param = $paramTemp;
$sayfa = $_GET["s"];

    if(!is_numeric($sayfa)){
        $sayfa = 1;
    }
$kacar = 5;
$kadi  = $_SESSION["kullaniciAdi"];
include "baglanti/db_baglan.php";
?>

<html>
<head>
    
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  <meta property="og:image" content="/images/kodcularSozlukLogo.png">
  <meta name="description" content="yazı | <?php echo $param;?>">
  <!-- Document title -->
  <title>sözlük | <?php echo $param;?></title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
  <link href="/css/entry.css" rel="stylesheet">
</head>

<body>
  <?php include "header.php";?>
  
  <hr class="space">
  
  <div class="genel">
       
            <?php 
        include "sol-nav.php";
          ?> 
          
          
     
    <style>
    
    .baslik:hover{
      text-decoration:none;
    }
    .genel{
             left: 15;
         }
    
    </style>
    
    <div class="orta">
      <div class="baslik baslik-lower">
        <h4><?php echo $param;?></h4>
      </div>
      
      <hr class="space">
      <?php 
      
      $varmiSorgu = "SELECT * from entryler where baslik = '$param' ORDER BY tarih ASC ";
      
        
      $varmiSorguYap = mysqli_query($baglan,$varmiSorgu);
      $varmiSayi= mysqli_num_rows($varmiSorguYap);

        $ksayisi = $varmiSayi;
        $ssayisi = ceil($ksayisi/$kacar);
        $nereden = ($sayfa*$kacar)-$kacar;
        
      $yeniSorgu = "SELECT * FROM entryler WHERE baslik = '$param' ORDER BY tarih ASC LIMIT $nereden,$kacar";
      $yeniSorguYap = mysqli_query($baglan,$yeniSorgu);
      $yeniSorguSayi = mysqli_num_rows($yeniSorguYap);    
      
        
      if($yeniSorguYap){
        
        for($i=0; $i<$yeniSorguSayi;$i++){
          
          $row= mysqli_fetch_array($yeniSorguYap);
          
          $entry_id = $row["id"];
          $yazarAdi = $row["kullaniciAdi"];
          $yazarEntry = $row["entry"];
          $yazarTarih = $row["tarih"];
          
          $begeniSorgu = "SELECT * FROM begeni where entry_id = '$entry_id' AND begenen='$kadi'";
          $begeniSorguYap= mysqli_query($baglan,$begeniSorgu);
          
          $dislikeSorgu = "SELECT * FROM dislike where entry_id = '$entry_id' AND dislike_atan ='$kadi'";
          $dislikeSorguYap = mysqli_query($baglan,$dislikeSorgu);
          
          $favSorgu = "SELECT * FROM favoriler where entry_id = '$entry_id' AND favlayan='$kadi'";
          $favSorguYap = mysqli_query($baglan,$favSorgu);
          
          
          $totalFavSorgu = "SELECT * FROM favoriler where entry_id='$entry_id'";
          $totalFavSorguYap = mysqli_query($baglan,$totalFavSorgu);
          $totalFavSayisi = mysqli_num_rows($totalFavSorguYap);
          
          echo '<div id="content-entry-load'.$i.'" class="content-entry">
          
          '.$yazarEntry.'
          
          <br>
          <br>
          
          <div class="entry-footer">
          
           <div class="fb-share-button" data-href="http://sozluk.codingtr.com" data-layout="button_count" data-size="small"><a target="_target" data-toggle="tooltip" data-placement="top" title="ficide paylaş" href="https://www.facebook.com/sharer/sharer.php?u=http://sozluk.codingtr.com/s/'.$param.'" class="face"><i class="fab fa-facebook-f"></i></a></div>
            &nbsp&nbsp
           <a target="_blank" href="https://twitter.com/intent/tweet?text='.$yazarEntry.' http://sozluk.codingtr.com/s/'.$param.'" class="twitter" data-toggle="tooltip" data-placement="top" title="tivitle beni"><i class="fab fa-twitter"></i></a>
            &nbsp&nbsp&nbsp&nbsp
          ';
          
          if($_SESSION["online"]){
              
          
          echo '<a href="javascript:;" id="begen'.$i.'" class="like" data-toggle="tooltip" data-placement="top" title="beğendim"><i class="icon-thumbs-up11"></i></a>
          &nbsp&nbsp
          <a href="javascript:;" id="begenme'.$i.'" class="dislike" data-toggle="tooltip" data-placement="bottom" title="beğenmedim"><i class="icon-thumbs-down11"></i></a>
          &nbsp&nbsp
          <a href="javascript:;" id="fav'.$i.'" class="fav" data-toggle="tooltip" data-placement="bottom" title="çok ii"><i class="fas fa-heart"></i></a>&nbsp<span class="fav-sayi">'.$totalFavSayisi.'</span>';
          
          }
           echo '
          <div class="sag-foter" style="float: right;">
          
          <a href="">'.$yazarTarih.'</a> <a style="color:#007fae" href="http://sozluk.codingtr.com/yazar/'.$yazarAdi.'">'.$yazarAdi.'</a>
          
          </div>
          
          </div>
          </div>
          
          ';
          

          echo "<hr class='space'>";       
          
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
        echo '<center><font style="font-weight:bold;color:#007fae;">Sayfa</font></center>';
        echo '<ul class="pagination justify-content-center">';
        echo '<li class="page-item"><a class="page-link" href="http://sozluk.codingtr.com/s/'.$param.'">1</a></li>';
           for($k=2;$k<=$ssayisi;$k++){
              
              echo '<li class="page-item"><a class="page-link" href="http://sozluk.codingtr.com/s/'.$param.'?s='.$k.'">'.$k.'</a></li>';
             }
          
        echo '</ul>';  
        
      }else{
        
        ?>
        <div class="baslik">
            
          <h4><?php echo $param;?></h4>
          
          <br>
          <p>böyle bir şey bulamadık.</p>
          <br>
        </div>
        
        <?php 
        
      }
      
      ?>

    <?php 
    
    if($_SESSION["online"]){

    ?>

      <hr class="space">
      <div class="content-entry">
        <div class="entry-section">
          
          <h4>bir şeyler eklemek ister misin?</h4>
          
          <form method="post">
            
            <button>(bkz:hede)</button>
            <button>hede</button>
            <button>*</button>
            <button>-spoiler</button>
            <button>http://</button>
            <br>
            <br>
            <textarea name="entry" placeholder="bir şeyler hakkında tanım yap"></textarea>
            <br>
            <br>
            <input type="submit" name="entryPostu" value="yolla babuş">
            
          </form>
          <?php 
          
          if($_POST["entryPostu"]){
            
            $yaziTemp = $_POST["entry"];
            $yazi = '<span>'.strtolower($yaziTemp).'</span>';
            $tarih = date('d.m.Y H:i');
            
            $entryEkleSorgusu = "INSERT INTO entryler (kullaniciAdi,baslik,entry,tarih)
            VALUES ('$kadi','$param','$yazi','$tarih')";
            
            $baslikEkleSorgusu = "INSERT INTO basliklar (kullaniciAdi,baslik,tarih)
            VALUES ('$kadi','$param','$tarih')";   
            
            $baslikEkle = mysqli_query($baglan,$baslikEkleSorgusu);
            $entrySorgusu = mysqli_query($baglan,$entryEkleSorgusu);
            
            if($entrySorgusu){
              
              sleep(2);
              
              header("Location: http://sozluk.codingtr.com/s/$param");
              
            }
            
          }
          
          ?>
        </div>

      </div>

<?php 

}

?>

    </div>
  
  </div>

 <script src="js/jquery.js"></script>
 <script src="js/plugins.js"></script>

<!--Template functions-->
 <script src="js/functions.js"></script> 
         
</body>

<?php 
include "footer.php";
?>
</html>