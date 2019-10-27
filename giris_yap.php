<?php 
include "baglanti/db_baglan.php";
session_start();

if($_SESSION["online"]){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="admin" />
    <meta name="description" content="giriş yap">
    <!-- Document title -->
    <title>sözlük | giriş yap</title>
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
        <section id="page-content">
            <div class="container">
                <div class="row">
                    <div class="content col-lg-9">

                        <h3>giriş yap</h3>
                        <form style="max-width: 25rem;" method="POST">
                            <div class="form-group">
                                <label style="text-transform:lowercase;" for="exampleInputEmail1">e-mail adresi</label>
                                <input required class="form-control" name="email" id="exampleInputEmail1" autofocus='autofocus' aria-describedby="emailHelp"
                                    placeholder="kullanici@ornek.com" type="email">
                            </div>
                            <div class="form-group">
                                <label style="text-transform:lowercase;" for="exampleInputPassword1">şifre</label>
                                <input required class="form-control" minlength="3" name="sifre" id="exampleInputPassword1" placeholder="******"
                                    type="password">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="exampleCheck1" type="checkbox">
                                <label class="form-check-label" for="exampleCheck1">bir dahaki sefere beni hatırla</label>
                            </div>
                            <button style="text-transform:lowercase;" type="submit" class="btn m-t-30 mt-3">giriş</button></br></br>
                        </form>
                        
                      <h4>bi' sorun mu var?</h4>
                         <a href="index.html">şifremi unuttum</a><br>
                         <a href="kayit_ol.php">aranıza katılmak istiyorum</a>
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
                else if(getenv("HTTP_X_FORWARDED_FOR")) {
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
            $ip = GetIP();
            $tarih = date('d.m.Y H:i:s');
            
            $email = $_POST["email"];
            $sifre = $_POST["sifre"];
            
            $sifreMD5 = md5($sifre);
            
            $girisKontrol = "SELECT * FROM kullanicilar WHERE mail='$email' AND sifre = '$sifreMD5'";
            
            $girisSorgusu = mysqli_query($baglan,$girisKontrol);
            
            if(mysqli_num_rows($girisSorgusu) > 0){
                
                
                $satir_say = mysqli_fetch_array($girisSorgusu);
                
                    $_SESSION['online'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['isimSoyisim']  = $satir_say["isimSoyisim"];
                    $_SESSION['kullaniciAdi'] = $satir_say["kullaniciAdi"];
                    $_SESSION['ip'] = $satir_say["ip"];
                    $_SESSION['dogumTarihi']  = $tarih;
                    $kadi = $satir_say["kullaniciAdi"];
                    
                $girisLog = "INSERT INTO giris_kaydi (kullaniciAdi,email,tarih,ip)
                              VALUES ('$kadi','$email','$tarih','$ip')";
                $girisKayitSorgusu = mysqli_query($baglan, $girisLog);
                
                
                echo "<font color='Green'>giriş başarılı, ana sayfaya yönlendiriliyorsunuz</font>";
                sleep(2);
                header("Location:index.php");
            }else{
                echo "<font color='Green'>giriş başarısız</font>";
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