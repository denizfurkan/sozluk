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
  <meta name="description" content="kisisel">
  <!-- Document title -->
  <title>sözlük | kisisel</title>
  <!-- Stylesheets & Fonts -->
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <link href="/css/sozluk.css" rel="stylesheet">
  
</head>

<body>
  <!-- Body Inner -->    <div class="body-inner">
  <script src="http://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
  <?php include "../header.php"; ?>
  
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
  
  <div class="container" >
    
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
                <a class="nav-link disabled" href="sifre.php">şifre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">kişisel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="hesabi_sil.php">hesabımı sil</a>
              </li>
            </ul>
          </div>
          
          <form onsubmit="return false;" style="max-width: 20rem; text-align:left; margin-left:10px"></br>
            
            <label style="text-align:left; margin-left:10px; width:1000px">
              <i class="fa fa-exclamation"></i>&nbsp&nbsp&nbsp<label>bilgilerinizin güvenliği için elimizden gelen özeni gösteriyoruz</br>
              </label></label>
              
              <label>isim & soyisim</label>
              
              <input required class="form-control"  type="text"
              id="example-text-input" value = "<?php echo $_SESSION['isimSoyisim']; ?>" name="isimSoyisim">
              
              
              <label>dogum tarihi</label>
              
              <input required class="form-control"  type="date" value= "<?php echo $_SESSION['dogumTarihi']; ?>"
              id="example-date-input" name="dogumTarihi">
              
              <label>cinsiyet</label> 
              
              <select class="form-control" id="exampleFormControlSelect1" name="cinsiyet">
                <option>boşver</option>
                <option>erkek</option>
                <option>kadın</option>
              </select>
              
              
              <input type="submit" onclick="gonder();" style="text-transform:lowercase;" class="btn mt-3" value="bilgileri güncelle">
            </form>
            
            
            <script type="text/javascript">
            
            function gonder()
            {
              
              var isimSoyisim=$("input[name='isimSoyisim']").val();
              var dogumTarihi=$("input[name='dogumTarihi']").val();
              var cinsiyet=$("input[name='cinsiyet']").val();
              
              $.ajax({
                
                type:"POST",
                url:"http://sozluk.codingtr.com/ayarlar/kisisel-islem.php",
                data:{isimSoyisim,dogumTarihi,cinsiyet},
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