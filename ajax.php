<?php 
include "baglanti/dbo_baglan.php";

  sleep(0.4);
  $valueTemp = $_POST["value"];
  $value = strtolower($valueTemp);
  
  function seflink($text)
{
$find =    array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#','Ã¼','Ä±','ÅŸ','Ã¶','Ã§');
$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp','ü','ı','ş','ö','ç');
$text = strtolower(str_replace($find, $replace, $text));
return $text;
}
 
  
  if($value){
	  $row = $db->prepare("SELECT * FROM basliklar WHERE baslik LIKE ? LIMIT 5");
	  $row->execute(array("%".$value."%"));
	  $goster = $row->fetchAll(PDO::FETCH_ASSOC);
	  $x = $row->rowCount();

	   if($x){
		   echo '<div class="arrow-up"></div>';
		   echo '<ul>';
		   
			 $i=0;
		   foreach($goster as $liste){
			   
			  
			  $i++;
			  
			   echo'<li><a href="http://sozluk.codingtr.com/s/'.seflink($liste["baslik"]).'">'.seflink($liste["baslik"]).'</a></li>';
			   
			   if( !($i == count($goster)) ){
			       echo "<hr>";
			   }else{
			       
			   }
			   
		
			   
	   }
	        
	       echo '</ul>';
	   }else {
		   
	   }
  }
 
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
			   
			   echo "<li><a href='http://sozluk.codingtr.com/yazar/".$liste["kullaniciAdi"]."'>".$liste["kullaniciAdi"]."</a></li>";
			   
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
 
  if(substr($value, 0, 1) == "#"){
      $rowCount = strlen($value);
      $rowRev =  substr($value, 1, $rowCount-1);
      $row = $db->prepare("SELECT * FROM entryler WHERE id LIKE ? LIMIT 5");
	  $row->execute(array("%".$rowRev."%"));
	  $goster = $row->fetchAll(PDO::FETCH_ASSOC);
	  $x = $row->rowCount();
	  
	   if($x){
	       echo '<div class="arrow-up"></div>';
	       echo '<ul>';
	        $i=0;
		   foreach($goster as $liste){
		       
			 $i++;
			   
			   
			   echo "<li><a href='javascript:;'>".seflink($liste["id"])."</a></li><hr>";
			   
			     if( !($i == count($goster)) ){
			       echo "<hr>";
			   }else{
			       
			   }
			   
			   
			   
			   
	   }
	       echo '</ul>';
	       
	   }else {
		   echo "aradıgınız entry'e ait hiç sonuc bulunamadı..";
	   }
  }
?>

