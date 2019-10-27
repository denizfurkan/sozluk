<!DOCTYPE html>
<?php 
session_start();
include "baglanti/db_baglan.php";
$yazar_adi = $_GET["q"];
$email_kayit = $_SESSION["email"];
$kadi = $_SESSION["kullaniciAdi"];
?>

<html lang="tr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  <meta property="og:image" content="/images/kodcularSozlukLogo.png">
  <meta name="description" content="<?php echo $yazar_adi;?> adında bir yazar.">
  <!-- Document title -->
  <title>yazar | <?php echo $yazar_adi;?></title>
  <!-- Stylesheets & Fonts -->
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
  <link href="/css/yazar.css" rel="stylesheet">
</head>

<body>
  <style>
  
  .dot {
    height: 3px;
    width: 3px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
  }
  
  .face{
    position: relative;
    top: 0px;
    
  }
  
  .header-searchbar form input{
    position:relative;
    top:-24px;
  }
  
  .header-searchbar form button{
    top:-24px;
  }
  
  .header-logo img{
    top: -11px;
  }
  #page-content{
    position: relative;
    top: -27px;
  }
  
  #sonuc{
    margin-top: -45px;
  }
  
</style>

<!-- Body Inner -->    
<div class="body-inner">
  <?php include "header.php"; ?>
  
  <hr class="space">
  <!-- Page Content -->
  <section id="page-content" class="sidebar-right">
    
    <div class="genel">    
      
      <div class="container">
        <?php include "sol-nav.php";?>
        <div class="row">
          <!-- content -->
          
          <style>
              
              .sol-taraf{
                  height:100%;
              }
              
          </style>
          
          <div class="post-item-description">
            <h3><?php echo $yazar_adi;?></h3>
            
            <?php
            $toplamEntry_sorgu = "SELECT * FROM entryler WHERE kullaniciAdi = '$yazar_adi'";
            $toplamEntry_sorgu_yap = mysqli_query($baglan,$toplamEntry_sorgu);
            $toplamEntry_satiri = mysqli_num_rows($toplamEntry_sorgu_yap);
            
            $toplamBaslik_sorgu = "SELECT * FROM basliklar WHERE kullaniciAdi = '$yazar_adi'";
            $toplamBaslik_sorgu_yap = mysqli_query($baglan,$toplamBaslik_sorgu);
            $toplamBaslik_satiri = mysqli_num_rows($toplamBaslik_sorgu_yap);
            
            $sonKayit_sorgu = "SELECT * FROM giris_kaydi WHERE kullaniciAdi='$yazar_adi' ORDER BY tarih DESC";
            
            $sonKayit_sorgu_yap = mysqli_query($baglan,$sonKayit_sorgu);
            $sonKayit_Array = mysqli_fetch_array($sonKayit_sorgu_yap);
            $sonKayit = $sonKayit_Array["tarih"];
            $sonKayit = substr("$sonKayit", 0, 10);
            
            $blockquote_sorgu = "SELECT * FROM entryler WHERE kullaniciAdi = '$yazar_adi' ORDER BY RAND() LIMIT 200";
            $blockquote_sorgu_yap = mysqli_query($baglan,$blockquote_sorgu);
            
            if(mysqli_num_rows($blockquote_sorgu_yap) > 0){
              $row = mysqli_fetch_assoc($blockquote_sorgu_yap);
              $entry_baslik = $row["baslik"];
              $tempEntry = $row["entry"];
              $entry = substr($tempEntry, 0, 500);
              $entry_id =$row["id"];
            }
            
            ?>
            
            <span title ="entry"  class="post-meta-comments"><?php echo $toplamEntry_satiri;?></span>
            <span style="position: relative; top: -2px;" class="dot"></span>
            <span title="başlık" class="post-meta-comments"><?php echo $toplamBaslik_satiri;?></span>
             <span style="position: relative; top: -2px;" class="dot"></span>
            <span class="post-meta-comments" title="son görülme"><?php echo $sonKayit;?></span>
            </br></br>
            
            <?php  
            if(strlen($entry_baslik) > 0){
                echo '<div class="blockquote"><p>'.$entry_baslik.'</p><small>'.$entry.'</small><small></br></br><a href="http://sozluk.codingtr.com/entry/'.$entry_id.'">devamını gör..</a></small></div>';
            }else {} ?>
            
          
          
           
            
            <div class="tabs">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#entry" role="tab" aria-controls="home" aria-selected="true">entry'ler</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#fav" role="tab" aria-controls="profile" aria-selected="false">favoriler</a>
                </li>
                <li class="nav-item"><div class="p-dropdown">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">istatistikler</a>
                  <ul class="p-dropdown-content dropdown-yazi">
                      
                    <li><a style="color:#000;" data-toggle="tab" role="tab" aria-controls="encokfav" aria-selected="false" id="encokfav-tab" href="#encokfav" role="tab">en çok favorilenenler</a></li>
                    <hr>
                    <li><a style="color:#000;" href="javascript:;">en çok beğenilenler</a></li>
                    <hr>
                    <li><a style="color:#000;" href="javascript:;">istatistikler</a></li>
                  </ul>
                </div>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="entry" role="tabpanel" aria-labelledby="home-tab">
                
                <?php 
                
                $entry_sorgu = "SELECT * FROM entryler WHERE kullaniciAdi = '$yazar_adi' ORDER BY id DESC";
                $entry_sorgu_yap = mysqli_query($baglan,$entry_sorgu);
                $entry_satiri = mysqli_num_rows($entry_sorgu_yap);
                
                
                
                
                
                ?>

                <h3 class="entry-baslik"><p class="text-info">entryler (<?php echo $entry_satiri;?>)</p></h3>
                
                <?php 
                
                if($entry_satiri > 0){
                  
                  for($i=0;$i<$entry_satiri;$i++){
                    
                    $row = mysqli_fetch_array($entry_sorgu_yap);
                    $entry_id = $row["id"];
                    $entry_baslik = $row["baslik"];
                    $entry = $row["entry"];
                    $entry_tarih = $row["tarih"];
                    
                    
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
                    
                    <div class="content-entry">
                      
                      <h3 class="entry-baslik-ic"><a href="http://sozluk.codingtr.com/s/<?php echo $entry_baslik;?>" class="entry-basligi"><?php echo $entry_baslik;?></a></h3>
                      
                      
                      <h4><p class="entry"><?php echo $entry;?></p></h4>

                      <div class="entry-footer">
                        <div class="fb-share-button" data-href="http://sozluk.codingtr.com" data-layout="button_count" data-size="small"><a target="_target" data-toggle="tooltip" data-placement="top" title="ficide paylaş" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://sozluk.codingtr.com/s/'.$entry_baslik;?>" class="face"><i class="fab fa-facebook-f"></i></a></div>
                        &nbsp&nbsp
                        <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $entry;?> <?php echo 'http://sozluk.codingtr.com/s/'.$entry_baslik;?>" class="twitter" data-toggle="tooltip" data-placement="top" title="tivitle beni"><i class="fab fa-twitter"></i></a>
                        &nbsp&nbsp&nbsp&nbsp
                        <?php 
                        
                        if($_SESSION["online"]){
                          
                          ?>
                          <a href="javascript:;" id="begen<?php echo$i;?>" class="like" data-toggle="tooltip" data-placement="top" title="beğendim"><i class="icon-thumbs-up11"></i></a>
                          &nbsp&nbsp
                          <a href="javascript:;" id="begenme<?php echo$i;?>" class="dislike" data-toggle="tooltip" data-placement="bottom" title="beğenmedim"><i class="icon-thumbs-down11"></i></a>
                          &nbsp&nbsp
                          <a href="javascript:;" id="fav<?php echo$i;?>"class="fav" data-toggle="tooltip" data-placement="bottom" title="çok ii"><i class="fas fa-heart"></i></a>&nbsp<span class="fav-sayi"><?php echo $totalFavSayisi?></span>
                          
                          <?php 
                          
                        }else{}
                          
                          ?>
                          
                          <div class="sag-foter" style="float: right;">
                            
                            <a href="http://sozluk.codingtr.com/entry/<?php echo $entry_id;?>"><?php echo $entry_tarih;?></a> <a style="color:#007fae" href=""><?php echo $yazar_adi;?></a>
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
                    
                  }else {echo "<center><h5>pek bir şey bulamadık.</h5></center>";}
  
                  $favSorgu = "SELECT *  FROM favoriler WHERE favlayan='$yazar_adi' ORDER BY id DESC";
                  $favSorguYap = mysqli_query($baglan,$favSorgu);
                  $favSatirSay = mysqli_num_rows($favSorguYap);
                  ?>
                  
                  
                </div>
                <div class="tab-pane fade" id="fav" role="tabpanel" aria-labelledby="profile-tab">
                  
                  <h3 class="entry-baslik"><p class="text-info">favoriler (<?php echo $favSatirSay;?>)</p></h3>
                  
                  <?php 
                  
                  if($favSatirSay > 0){
                    
                    for($k=0;$k<$favSatirSay;$k++){
                      
                      $favSatirBul= mysqli_fetch_array($favSorguYap);
                      $favId = $favSatirBul["entry_id"];
                      
                      $favEntryBul      = "SELECT * FROM entryler WHERE id ='$favId'";
                      $favEntrySorguYap = mysqli_query($baglan,$favEntryBul);
                      $favEntrySatirBul = mysqli_fetch_array($favEntrySorguYap);
                      
                      $favEntryBaslik = $favEntrySatirBul["baslik"];
                      $favEntry       = $favEntrySatirBul["entry"];
                      $favEntryId     = $favEntrySatirBul["id"];
                      $favEntryTarih  = $favEntrySatirBul["tarih"];
                      $favEntryYazar  = $favEntrySatirBul["kullaniciAdi"];
                      
                      ?>
                      
                      
                      <div class="content-entry">
                        
                        <h3 class="entry-baslik-ic"><a href="http://sozluk.codingtr.com/s/<?php echo $favEntryBaslik;?>" class="entry-basligi"><?php echo $favEntryBaslik;?></a></h3>
                        
                        <h4><p class="entry"><?php echo $favEntry;?></p></h4>

                        <div class="entry-footer">
                          <div class="fb-share-button" data-href="http://sozluk.codingtr.com" data-layout="button_count" data-size="small"><a target="_target" data-toggle="tooltip" data-placement="top" title="ficide paylaş" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://sozluk.codingtr.com/s/'.$favEntryBaslik;?>" class="face"><i class="fab fa-facebook-f"></i></a></div>
                          &nbsp&nbsp
                          <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $favEntry;?> <?php echo 'http://sozluk.codingtr.com/s/'.$favEntryBaslik;?>" class="twitter" data-toggle="tooltip" data-placement="top" title="tivitle beni"><i class="fab fa-twitter"></i></a>
                          
                          <div class="sag-foter" style="float: right;">
                            
                            <a href="http://sozluk.codingtr.com/entry/<?php echo $favEntryId;?>"><?php echo $favEntryTarih;?></a> <a style="color:#007fae" href="http://sozluk.codingtr.com/yazar/<?php echo $favEntryYazar;?>"><?php echo $favEntryYazar;?></a>
                          </div>
                        </div>
                      </div>
                      
                      <hr class="space">
                      <?php 
                    }
                  }else{
                    
                    echo "<center><h5>pek bir şey bulamadık.</h5></center>";
                  }

                  ?>
                  
                </div>
                
              </div>
            </div>
            
          </div>
          
        </div>
        
      </div>  
      
    </div>
    
  </div>
</section>
<!-- end: Page Content -->


<!-- end: Body Inner -->

<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

<!--Plugins-->
<script src="/js/jquery.js"></script>
<script src="/js/plugins.js"></script>

<!--Template functions-->
<script src="/js/functions.js"></script>

</body>

<?php 
include "footer.php";
?>

</html>
