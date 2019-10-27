<?php
   try {
	  $db = new PDO("mysql:host=;dbname=;charset=utf8","","");
   }catch (PDOException $mesaj) {
	  echo $mesaj->getmessage();
   }
?>
