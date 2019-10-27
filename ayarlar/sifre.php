<!DOCTYPE html>
<html lang="tr">

<?php
include "../baglanti/db_baglan.php";
session_start();
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <meta name="description" content="sifre">
  <!-- Document title -->
  <title>sözlük | sifre</title>
  <!-- Stylesheets & Fonts -->
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
</head>

<body>
  <!-- Body Inner -->    <div class="body-inner">
  
  <?php 
  include "../header.php";
  ?>
  
  <hr class="space">
  
  <style>
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
  .genel{
      top: -4px;
  }
  #sonuc{
      margin-top: -45px;
  }
  
</style>
<div class="genel">
  <div id="sonuc"></div>
  <div class="container">
    
    <?php include "../sol-nav.php";?>
    
    <div class="row" style="margin-left:20px;">
      <div class="col-lg-12 mb-4">
        <h4>ayarlar</h4>
      </div>
      <div class="col-lg-12 mb-4">
        <div class="card text-center" style="width: 736px;">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link disabled" href="e-posta.php">e-posta adresi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="javascript:;">şifre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="kisisel.php">kişisel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="hesabi_sil.php">hesabımı sil</a>
              </li>
            </ul>
          </div>
          
          <form onsubmit="return false;" style="max-width: 20rem; text-align:left; margin-left:10px" method="POST"></br>
            <label style="text-align:left; margin-left:10px; width:1000px">
              <i class="fa fa-exclamation"></i>&nbsp&nbsp&nbsp<label>hesabınızı güvende tutmak için daha <b>güçlü şifreler</b> kullanın</br>
              </label></label>
              
              <label>şu anki şifreniz</label>
              <input required class="form-control" id="inputPassword3" placeholder="******"
              type="password" name="sifre">
              
              <label>yeni şifre</label>
              <input required class="form-control"
              type="password" name="yeniSifre">
              
              <label>yeni şifre (doğrula)</label>
              <input required class="form-control"
              type="password" name="yeniSifreTekrar">
              
              <input onclick="gonder();" style="text-transform:lowercase;" type="submit" class="btn mt-3"></br></br>
              
            </form>
            
            <script type="text/javascript">
            
            function gonder()
            {
              
              var sifre=$("input[name='sifre']").val();
              var yeniSifre=$("input[name='yeniSifre']").val();
              var yeniSifreTekrar=$("input[name='yeniSifreTekrar']").val();
              
              $.ajax({
                type:"POST",
                url:"http://sozluk.codingtr.com/ayarlar/sifre-islem.php",
                data:{sifre,yeniSifre,yeniSifreTekrar},
                success:function(sonuc){
                  $("#sonuc").html(sonuc);
                }
              })
            }
            </script>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- end: Page Content -->



</div>
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
include "../footer.php";
?>
</html>