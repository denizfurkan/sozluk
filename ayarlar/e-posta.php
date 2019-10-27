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
  <meta name="description" content="e-posta">
  <!-- Document title -->
  <title>sözlük | e-posta</title>
  <!-- Stylesheets & Fonts -->
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
</head>

<body>
  <!-- Body Inner -->
  <script src="http://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
  <?php include "../header.php";?>
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
                <a class="nav-link active" href="javascript:;">e-posta adresi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="sifre.php">şifre</a>
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
            
            <label >şu anki e-posta adresiniz</label>
            <input class="form-control" name="email" readonly="" value = "<?php echo $_SESSION['email'];?>" type="email">
            
            <label>şifre</label>
            <input class="form-control" id="inputPassword3" placeholder="******" name="sifre"  type="password">
            
            <label>yeni e-posta adresi</label>
            <input required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="yeniMail" type="email">
            
            <label>yeni e-posta adresi (doğrula)</label>
            <input required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="yeniMailTekrar" type="email">
            
            <input type="submit" onclick="gonder();" style="text-transform:lowercase;"  class="btn mt-3"></br></br>
            
          </form>
          
          <script type="text/javascript">
          
          function gonder()
          {
            var email=$("input[name='email']").val();
            var sifre=$("input[name='sifre']").val();
            var yeniMail=$("input[name='yeniMail']").val();
            var yeniMailTekrar=$("input[name='yeniMailTekrar']").val();
            
            $.ajax({
              
              type:"POST",
              url:"http://sozluk.codingtr.com/ayarlar/e-posta-islem.php",
              data:{email,sifre,yeniMail,yeniMailTekrar},
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