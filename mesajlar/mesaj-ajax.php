<?php 
include "../baglanti/dbo_baglan.php";

  sleep(0.4);
  $valueTemp = $_POST["value"];
  $value = strtolower($valueTemp);
 
  if(substr($value, 0, 1) == "@"){
      $rowCount = strlen($value);
      $rowRev =  substr($value, 1, $rowCount-1);
      $row = $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciAdi LIKE ? LIMIT 5");
	  $row->execute(array("%".$rowRev."%"));
	  $goster = $row->fetchAll(PDO::FETCH_ASSOC);
	  $x = $row->rowCount();
	  
	   if($x){
	       echo '<div class="arrow-up"></div>';
	       echo '<ul>';
	      $i=0;
		   foreach($goster as $liste){
			  $i++;
			   echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
			   echo "<li id='yazi".$i."'>".$liste["kullaniciAdi"]."</li>";
			   echo '<script>$("#yazi'.$i.'").click(function(){
			       
			       $("#kisitag").val("'.$liste["kullaniciAdi"].'");
			       $("#getir").hide();
			       
			   });</script>';
			   if( !($i == count($goster)) ){
			       echo "<hr>";
			   }else{
			       
			   }
	         }
	       echo '</ul>';
	       
	   }else {
		   echo "aradıgınız kullanıcıya ait hiç sonuc bulunamadı..";
	   }
  }
?>