<?php 

session_start();
include "../baglanti/db_baglan.php";
$kadi = $_SESSION["kullaniciAdi"];
?>

<html>
<head>  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=yes, minimal-ui">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="admin" />
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  <meta property="og:image" content="images/kodcularSozlukLogo.png">
  <meta name="description" content="teknolojik sözlük">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  
  <!-- Document title -->
  <title>sözlük | kodcular</title>
  
  <link href="/css/plugins.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="/css/header.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="/css/kisi-nav.css" rel="stylesheet">
</head>

<body>
<script src="/js/plugins.js"></script>
<script src="/js/functions.js"></script>
<?php include "../header.php";?>
<br>

<div class="sayfa-genel">

            <div class="sol-kisiler">
            
            <div class="yazarlar">
                <span>yazarlar</span>
                 
            </div>
            <ul class="list-icon list-icon-colored liste">
                    
           <?php 
           
            $sonMesajSorgu = "SELECT distinct gonderici FROM mesajlar WHERE alici = '$kadi' ORDER BY id DESC";
            $sonMesajSorguYap= mysqli_query($baglan,$sonMesajSorgu);
            $sonMesajSorguSayisi = mysqli_num_rows($sonMesajSorguYap);
            
                for($i=0;$i<$sonMesajSorguSayisi;$i++){
                    $row = mysqli_fetch_array($sonMesajSorguYap);
                    $gonderici = $row["gonderici"];

                    echo '<a href="javascript:;" id="gonderen'.$i.'" class="gonderen"><li><i class="fa fa-user"></i>'.$gonderici.'</li></a>';
                    
           ?>
           <script>
           $(document).on("click", "#gonderen<?php echo $i;?>", function() {
      
                         $("#mesajlar").attr("src", "http://sozluk.codingtr.com/mesajlasma.php?id=<?php echo $gonderici;?>");
                         $("#mesajlasilan").html("<?php echo $gonderici;?>");
                         $("#gonderilen").attr("value", "<?php echo $gonderici;?>");
                          });
                          
            </script>
                            
              <?php 
              
                }
                
                $farkliSorgu = "SELECT distinct gonderici FROM mesajlar WHERE alici = '$kadi' ORDER BY id DESC";
                $farkliSorguYap = mysqli_query($baglan,$farkliSorgu);
                $farkliSorguSatir = mysqli_fetch_array($farkliSorguYap);
                
                $sonGonderen = $farkliSorguSatir["gonderici"];
                
              
              ?>              
                        </ul>

            </div>

<div class="genel-orta">
    <div class="card bg-light mb-3 mesaj">
                                    <div class="card-header">
                                        <div class="user">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <span id="mesajlasilan" value="sa"><?php echo $sonGonderen;?></span>
                                        
                                 <button class="btn btn-sm btn-slide btn-light yeniMsg" data-width="130" style="width: 36px;position: absolute;right: 6px;top: 3px;" data-target="#modal" data-toggle="modal"><i class="fa fa-user-edit"></i>
                                    <span>yeni mesaj</span></button>

                                    </div>
                                    
                                    <div id="card" class="card-body">
                                        
                                          
                                        
                                       <!-- Burada IFRAME olacak. gelen mesajları bu i frame'e göre listeleyeceğiz. !-->
                                        
                                        <iframe id="mesajlar" src="http://sozluk.codingtr.com/mesajlasma.php?id=<?php echo $sonGonderen;?>"></iframe>
                                        <br />
                                        <br />
                                        <form id="mesajYolla" method="POST" >
                                           <input id="mesaj" name="mesaj" autocomplete="off" type="text">
                                           <input type="text" style="position:Absolute;visibility:hidden;" id="gonderilen" name="gonderilen" value="<?php echo $sonGonderen;?>">
                                           <button id="yolla" type="button" >yolla baqım</button>
                                        </form>
                                        
                                        
                                      <script>
                                            
                                            $(document).on('click', '#yolla', function(e) {
                                                   e.preventDefault();
                                                    
                                              $.ajax({
                                                type: 'POST',
                                                url: 'http://sozluk.codingtr.com/mesajlar/post.php',
                                                data: {
                                                      mesaj: $("#mesaj").val(),
                                                      gonderilen: $("#gonderilen").val(),
                                                    },
                                                success: function (data) {
                                                  $('audio').get(0).play();
                                                  $("#mesaj").val("")
                                                  $("#card").load(location.href + " #card>*", "");
                                                  
                                                }
                                              });
                                             
                                            });
                                        </script>
                                       
      </div>
      <audio controls hidden>
                                          <source src="tone/for-sure.mp3" type="audio/mp3" visible="hidden">
                                        </audio>
    </div>
</div>
</div>

<script type="text/javascript">
    $(function(){
	   $("#getir").hide();
	   $("#getir").css("border-color", "#121212");
	   
	   $("input[name=gonderilen]").keyup(function(){
		   var value  = $(this).val();
		   var konu   = "value="+value;
        
		   $.ajax({
			   type: "post",
               url:   "http://sozluk.codingtr.com/mesajlar/mesaj-ajax.php",
               data: konu,
               success: function(getir){
                   $("#getir").css("background-color", "#121212");
                   $("#getir").css("border", "2px solid");
	               $("#getir").css("border-color", "#007fae");
	               $("#getir").css("border-radius","5px");
				   $("#getir").html(getir).show();
				  
				  if($.trim(getir) == ''){
				      	   $("#getir").hide();
				  }
			   },
			   error: function(){
			       $("#getir").hide();
			   }
		   }
		   );
	   });
	});

  </script>

<div class="modal fade" id="modal" tabindex="-1" role="modal" aria-labelledby="modal-label" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-label">yeni mesaj</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        
                        <form method="POST">
                            
                            <input required oninvalid="this.setCustomValidity('birşey yazmadan gidemeyiz')" type="search" autocomplete="off" id="kisitag" name="gonderilen" placeholder="@yazar">
                            
                            <div style="position: absolute;margin-left:3px;margin-top:3px;" id="getir">
  
                            </div>
                            
                            <br/>
                            
                            <br/>
                            
                            <textarea placeholder="ne oldu?" name="mesaj"></textarea>
                            
                    </div>
                    <div class="modal-footer">
                        <button style="text-transform:lowercase" type="button" class="btn btn-b btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> vazgeçtim ya</button>
                        <button style="text-transform:lowercase" type="submit" class="btn btn-b btn-success"><i class="icon-mail"></i> göndereyim</button></form> 
                    </div>
                </div>
            </div>
            
            <?php 

            if($_POST){
                
                $gonderilen = $_POST["gonderilen"];
                $gonderen = $_SESSION["kullaniciAdi"];
                $mesaj = $_POST["mesaj"];
                $tarih = date('d.m.Y H:i');
                $ip = $_SESSION["ip"];
                
                if($gonderilen == $gonderen){
                    
                    echo "kendine nasıl göndercen yav";
                    
                }else{
                
                $mesajSorgu = "INSERT INTO mesajlar (gonderici, alici, mesaj, tarih, ip)
                                        VALUES ('$gonderen', '$gonderilen', '$mesaj', '$tarih', '$ip');";
                $mesajSorguYap = mysqli_query($baglan,$mesajSorgu);
                                        
                if($mesajSorguYap){
                    
                    header("location: http://sozluk.codingtr.com/mesajlar");
                    
                }else{
                    
                }
                
            }
                    
                }

            ?>
 
        </div>
</body>
</html>