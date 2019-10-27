<div class="sol-taraf" id="sol" style="margin-left: -15px;">
<ul class="list-group">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>    
<?php 
session_start();
include "baglanti/db_baglan.php";

$sorguBaslik = "SELECT baslik FROM basliklar ORDER BY id DESC LIMIT 20";
$sorguOlusturBaslik = mysqli_query($baglan, $sorguBaslik);
    
    echo '<div class="sozluk-icon"><i id="icon-refresh" class ="icon-refresh-ccw"></i></div><h4 class="baslik-sol-frame">taze</h4> ';
    
    while ($b=mysqli_fetch_array($sorguOlusturBaslik)){
        $baslik = $b['baslik'];
        
        $sorguBaslikSayisi = "SELECT * FROM entryler WHERE baslik='$baslik'";
        $sorguOlusturBaslikSayisi = mysqli_query($baglan, $sorguBaslikSayisi);
        
        $sayi = mysqli_num_rows($sorguOlusturBaslikSayisi);
        
        if($sayi > 1 || $sayi = 0){
        
        echo  '<li class="list-group-item d-flex justify-content-between align-items-center">
                <a class="baslik-lower" href="/s/'.$baslik.'">'.$baslik.'</a> 
                &nbsp<span class="badge badge-info">'.$sayi.'</span>';
        }else{
            
             echo  '<li class="list-group-item d-flex justify-content-between align-items-center">
                <a class="baslik-lower" href="/s/'.$baslik.'">'.$baslik.'</a> ';
            
        }
    }

?>
</ul>


  <script>
    
    $(document).on('click', '#icon-refresh', function() {
      
      $("#sol").load(location.href + " #sol>*", "");
       
       
  });


</script>

</div>