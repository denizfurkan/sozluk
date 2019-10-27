<!DOCTYPE html>
<html lang="tr">

<?php 
include "baglanti/db_baglan.php";
session_start();

if($_SESSION["online"]){
  header("Location: index.php");
}
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <meta name="description" content="sözlük kaydı">
  <!-- Document title -->
  <title>sozluk | kayit ol</title>
  <!-- Stylesheets & Fonts -->
  
  <link href="css/plugins.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">
  <link href="css/sozluk.css" rel="stylesheet">
</head>

<body>
   <script> src="http://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
  <?php include "header.php";?>
  <!-- Body Inner -->
      
  <div class="body-inner">

    <!-- Page Content -->
    <section id="page-content" style="height: 1080px;">
      <div class="container">
        <div class="row">
          <div class="content col-lg-9" style="margin: 0 auto;margin-left: 107px;">
            
            <h3>kişisel şeyler</h3>
            <form method="POST">
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-text-input" class="col-2 col-form-label">isim&soyisim</label>
                <div class="col-10">
                  <input required class="form-control" name="isimSoyisim" autofocus='autofocus'  type="text" placeholder="selahattin özdemir"
                  id="example-text-input">
                </div>
              </div>
              
              <hr class="space">
              
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-email-input" class="col-2 col-form-label">e-mail adresi</label>
                <div class="col-10">
                  <input required  class="form-control" name="mail" type="email" placeholder="selahattin@ornek.com"
                  id="example-email-input">
                </div>
              </div>
              
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-datetime-local-input" class="col-2 col-form-label">dogum tarihi</label>
                <div class="col-10">
                  <input required class="form-control" name="tarih" type="date" value="2019-09-16"
                  id="example-datetime-local-input">
                </div>
              </div>
              
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-datetime-local-input" class="col-2 col-form-label">cinsiyet</label>
                <div class="col-10">
                  <select name="cinsiyet" class="form-control" id="exampleFormControlSelect1">
                    <option>boşver</option>
                    <option>erkek</option>
                    <option>kadın</option>
                  </select>
                </div>
              </div>
              
              <hr class="space">
              
              <div class="line"></div>
              
              <h3>giriş yapman için</h3>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                
                <input required type="text" name="kadi" class="form-control" placeholder="golden dragon" aria-label="Username"
                aria-describedby="basic-addon1">
              </div>
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-password-input" class="col-2 col-form-label">şifre</label>
                <div class="col-10">
                  <input required class="form-control" name="sifre" type="password" placeholder="******"
                  id="example-password-input">
                </div>
              </div>
             <hr class="space">
              <div class="form-group row">
                <label style="text-transform:lowercase;" for="example-password-input" class="col-2 col-form-label">şifre tekrar</label>
                <div class="col-10">
                  <input required  class="form-control" name="sifreTekrar" type="password" placeholder="******"
                  id="example-password-input"></br></br>
                </div>
              </div>
              <hr class="space">
              <div class="form-check">
                <input required class="form-check-input" id="exampleCheck1" type="checkbox">
                <label class="form-check-label" for="exampleCheck1"><a href="javascript:;">sözlük kullanıcı sözleşmesi</a>ni okudum ve kabul ediyorum</label>
              </div>
              <hr class="space">
              <button style="text-transform:lowercase;" type="submit" class="btn">kayit ol</button>
            </form>
          </div>
          
        </div>
      </div>
    </section>
    <!-- end: Page Content -->
    
    <?php 
    if($_POST){
      
      function GetIP(){
        if(getenv("HTTP_CLIENT_IP")) {
          $ip = getenv("HTTP_CLIENT_IP");
        } 
        elseif(getenv("HTTP_X_FORWARDED_FOR")) {
          $ip = getenv("HTTP_X_FORWARDED_FOR");
          if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
          }
        }else {
          $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
      }
      
      $isimSoyisimTemp = $_POST["isimSoyisim"];
      $isim = strtolower($isimSoyisimTemp);
      $mail = $_POST["mail"];
      $tarih = $_POST["tarih"];
      $cinsiyet = $_POST["cinsiyet"];
      $kullaniciAdiTemp = $_POST["kadi"];
      $kadi = strtolower($kullaniciAdiTemp);
      $sifre = $_POST["sifre"];
      $sifreTekrar = $_POST["sifreTekrar"];
      
      $ip = GetIP();
      
      $sifreMD5 = md5($sifre);
      
      if($sifre == $sifreTekrar){
        
        $kullaniciAdiKontrol = "SELECT * FROM kullanicilar WHERE kullaniciAdi ='$kadi'";
        $kullaniciAdiKontrolSorgu = mysqli_query($baglan, $kullaniciAdiKontrol); 
        
        if(mysqli_num_rows($kullaniciAdiKontrolSorgu) > 0){
          echo "kayıt olunamadı, kullanıcı adı zaten var";
        }else{
          $emailKontrol = "SELECT * FROM kullanicilar WHERE mail = '$mail'";
          $emailKontrolSorgu = mysqli_query($baglan, $emailKontrol); }
          
          if(mysqli_num_rows($emailKontrolSorgu) > 0){
            echo "kayıt olunamadı, email zaten var";
          }else{
            $kayit_sorgusu = "INSERT INTO kullanicilar (isimSoyisim,mail,tarih,cinsiyet,kullaniciAdi,sifre,ip)
            VALUES ('$isim','$mail','$tarih','$cinsiyet','$kadi','$sifreMD5','$ip')";
            
            $kayit_sorgu_yap = mysqli_query($baglan,$kayit_sorgusu);
            
            $_SESSION['online'] = true;
            $_SESSION['kullaniciAdi'] = $kadi;
            $_SESSION['email'] = $mail;
            $_SESSION['isimSoyisim'] = $isim;
            $_SESSION['dogumTarihi'] = $tarih;
            $_SESSION['ip'] = $ip;
          }
          
          if($kayit_sorgu_yap){
            echo "<font color='Green'>kayıt başarılı, giriş sayfasına yönlendiriliyorsunuz</font>";
            header("Location: index.php");
          }
          
          else {
            echo "<font color='red'>kayıt olunamadı, bilgileri tekrar gözden geçiriniz</font>";
          }
        }
        else{
          echo "<font color='red'>kayıt olunamadı, şifrenizi tekrar gözden geçirin ve aynı olduğundan emin olun</font>";
        }
        
      }
      
      ?>
     
    </div>
    <!-- end: Body Inner -->
   
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>
    
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    
    <!--Template functions-->
    <script src="js/functions.js"></script>
  </body>
<?php 
include "footer.php";
?>
  </html>