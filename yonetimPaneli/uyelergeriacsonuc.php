<?php
if (isset($_SESSION["Yonetici"])) {
   if (isset($_GET["ID"])) {//arama çubuğundan geldiği için get le aldık.
   	 $Gelenid=guvenlik($_GET["ID"]);
   }else{
   	 $Gelenid="";
   }
   if($Gelenid!=""){
      
      $uye_geriac_sorgusu=$baglan->prepare("UPDATE uyeler SET SilinmeDurumu=? WHERE id=? LIMIT 1");
      $uye_geriac_sorgusu->execute([0,$Gelenid]);
      $sayi=$uye_geriac_sorgusu->rowCount();
      if ($sayi>0) { 
         header("Location:index.php?SKD=0&SKI=87");
         exit();
      }else{
         header("Location:index.php?SKD=0&SKI=88");
         exit();
      }
   }else{
      header("Location:index.php?SKD=0&SKI=88");
      exit();
   }
}else{
   header("Location:index.php?SKD=0&SKI=1");
   exit();
}

?>