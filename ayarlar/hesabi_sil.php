<!DOCTYPE html>
<html lang="tr">

<?php 
session_start();
include "../baglanti/db_baglan.php";
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <meta name="description" content="hesabı sil">
  <!-- Document title -->
  <title>sözlük | hesabı sil</title>
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
<!-- Page Content -->
<div class="genel">
  <div class="container">
    <?php include "../sol-nav.php";?>
    
    <div class="row"  style="margin-left:20px;">
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
                <a class="nav-link disabled" href="kisisel.php">kişisel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="javascript:;">hesabımı sil</a>
              </li>
            </ul>
          </div>
          
          <form style="max-width: 20rem; text-align:left; margin-left:10px" method="POST"></br>
            <label>bu işlemi gerçekleştirdiğiniz takdirde geri dönüşü olmayacaktır</label>       
            <label>şifre</label>
            <input required class="form-control" id="inputPassword3" name="sifre" placeholder="******" type="password"></br>
            
            <div class="form-check">
              <input required class="form-check-input" id="exampleCheck1" type="checkbox">
              <label class="form-check-label" for="exampleCheck1">hesabımın ve girilerimin tamamının silineceğini anlıyorum</label></br>
            </div>
            
            <button style="text-transform:lowercase;" type="submit" class="btn mt-3">bitir</button></br></br>
            
          </form>
        </div>
      </div>
    </div>
    
  </div>
  
  <!-- end: sidebar-->
</div>
</div>
<!-- end: Page Content -->


<?php 

if($_POST){
  
  $mail  = $_SESSION['email'];
  $sifre = $_POST["sifre"];
  
  $sifreMD5 = md5($sifre);
  
  $sifreKontrol = "SELECT * FROM kullanicilar WHERE sifre='$sifreMD5' AND mail='$mail'";
  $sifreKontrolSorgu = mysqli_query($baglan, $sifreKontrol);
  
  if(mysqli_num_rows($sifreKontrolSorgu) > 0){
    $kullaniciSilme = "DELETE FROM kullanicilar WHERE mail='$mail' AND sifre='$sifreMD5'";
    mysqli_query($baglan, $kullaniciSilme);
    
    header("Location: ../cikis_yap.php");
  }else{
    echo "şifrenizi kontrol edin";
  }
}

?>

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