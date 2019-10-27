<header id="header">
  
  <link src="css/header.css" rel="stylesheet">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(function(){
	   $("#sonuc").hide();
	   $("#sonuc").css("border-color", "#121212");
	   
	   $("input[name=q]").keyup(function(){
		   var value  = $(this).val();
		   var konu   = "value="+value;
        
		   $.ajax({
			   type: "post",
               url:   "http://sozluk.codingtr.com/ajax.php",
               data: konu,
               success: function(sonuc){
                   $("#sonuc").css("background-color", "#fff");
                   $("#sonuc").css("border", "1px solid")
	               $("#sonuc").css("border-color", "#dce0e1");
				  $("#sonuc").html(sonuc).show();
				  
				  if($.trim(sonuc) == ''){
				      	   $("#sonuc").hide();
				  }
			   },
			   error: function(){
			       $("#sonuc").hide();
			   }
		   }
		   );
	   });
	});

  </script>
  
  <div class="header-inner">
    <div class="header-center">
      <div class="header-logo">
        <a href="http://sozluk.codingtr.com"><img src="/images/sozlukKodcularLogoDark.png"></a>
      </div>
      
      <div class="header-searchbar">
        <form action="http://sozluk.codingtr.com/search.php">
          <input required oninvalid="this.setCustomValidity('birşey yazmadan gidemeyiz')" type="search" name="q" autocomplete="off" placeholder="başlık, @yazar, #giri">
          <button type="submit"><i class="fa fa-search"></i></button>
           <div id="sonuc">
               
	       </div>
         
          
        </form>
        
        
      </div>
      
      <div class="header-person-info">
        <?php 
        if(!$_SESSION["online"]){
          ?>
          <ul>
            <li class="animated visible fadeIn"><a href="http://sozluk.codingtr.com/giris_yap.php"><i class="icon-log-in"></i> giriş Yap </a></li>
            <li class="animated visible fadeIn"><a href="http://sozluk.codingtr.com/kayit_ol.php"><i class="fa fa-lock"></i> kayıt Ol</a></li>
            <li class="animated visible fadeIn"><a href="http://sozluk.codingtr.com/bulten.php"><i class="fa fa-bell"></i> bülten</a></li>
          </ul>
          
          <?php 
        }else{
          
          
          ?>
          <ul>
            <li class="animated visible fadeIn"> <div class="p-dropdown">
              <a href="http://sozluk.codingtr.com/yazar/<?php echo $_SESSION["kullaniciAdi"];?>"><i class="fa fa-user-check"></i> <?php echo $_SESSION["kullaniciAdi"]?> </a>
              <ul class="p-dropdown-content dropdown-yazi">
                <li><a style="color:#000;" href="http://sozluk.codingtr.com/yazar/<?php echo $_SESSION["kullaniciAdi"];?>"><i class="fa fa-user-circle"></i> sen</a></li>
                <hr>
                <li><a style="color:#000;" href="http://sozluk.codingtr.com/ayarlar/e-posta.php"><i class="icon-settings1"></i> ayarlar</a></li>
                <hr>
                <li><a style="color:#000;" href="http://sozluk.codingtr.com/cikis_yap.php"><i class="icon-log-out"></i> git burdan</a></li>
              </ul>
            </div></li>
            <li class="animated visible fadeIn"><a href="http://sozluk.codingtr.com/mesajlar"><i class="icon-message-circle"></i> mesajlar</a></li>
            <li class="animated visible fadeIn">
              
              <div class="p-dropdown">
                
                <a href="javascript:;"><i class="fa fa-bell"></i> bildirim</a>
                
                <div class="p-dropdown-content">
                  <div class="widget-notification">
                    <h4 class="mb-0">bildirimler</h4>
                    <p class="text-muted">yeni 2 bildirim</p>
                    
                    <div class="notification-item notification-new">
                      <div class="notification-meta">
                        <span>sozluk.kodcular açıldı!</span>
                        <span>3:57</span>
                      </div>
                    </div>
                    
                    <hr>
                    <a href="#" class="text-theme">son bildirimler</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          
          <?php 
          
        }
        ?>
        
      </div>
      
      <div class="header-menu">
        
        <ul>
          <li><a href="javascript:;">taze</a></li>
          <li><a href="javascript:;">#teknoloji</a></li>
          <li><a href="javascript:;">#yazılım</a></li>
          <li><a href="javascript:;">#donanım</a></li>
          <li><a href="javascript:;">#oyun</a></li>
        </ul>
        
      </div>
      
      <div class="header-right-shortcut">
        
        <a target="_blank" href="">kod öğren!</a>
        
      </div>
    </div>
  </div>
</header>